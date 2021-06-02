<?php

namespace App\Http\Controllers;

use App\utils\Pmc\AssetsManager;
use App\utils\Pmc\EmailManager\EmailManager;
use App\utils\Pmc\ImageUpload\ImageChecker;
use App\utils\Pmc\ImageUpload\ImageDataAccessAbstract;
use App\utils\Pmc\PmcForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use App\Models\PmcForm as PmcModel;


class PmcController extends Controller
{

    public function welcome(Request $request) {
        if($email = $request->email) {
            if(
                $modelFound = PmcModel::where('email', $email)
                    ->where('status', PmcModel::STATUS_NEW)
                    ->where('instance', instance()->Code())
                    ->first()
            ) {
                $pmc = PmcForm::FromModel($modelFound);
                session(["pmc_hash.{$pmc->ShortHash()}" => $pmc->Hash(), ]);
                return Redirect::route('pmc.email', ['hash' => $pmc->ShortHash(), ]);
            } else {
                return Redirect::route('pmc.email', ['email' => $email, ]);
            }
        }

        return Redirect::route('pmc.email');
    }

    public function emailForm(Request $request, $hash = '') {
//dump($request->getHost())      ;
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            $pmc = PmcForm::CreateNew();
            if($request->email) {
                $pmc->GetModel()->email = $request->email;
            }
        }

        return Inertia::render('Pmc/Email', [
            'inputHash' => $pmc->ShortHash(),
            'inputData' => $pmc->Email()->toJson(),
        ]);
    }

    public function emailSubmit(Request $request) {

        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            $pmc = PmcForm::CreateNew();
        }
        $pmc->Email()->FillFromRequest($request);
        $pmc->Save();

        return Redirect::route('pmc.assets', [
            'hash' => $pmc->ShortHash(),
        ]);
    }


    public function longHashRecover($hash = '') {
        $model = PmcModel::where('hash', $hash)->first();
        if(!$model) return abort(404);

        $pmc = PmcForm::FromHash($hash);

        session(["pmc_hash.{$pmc->ShortHash()}" => $hash, ]);

        return Redirect::route('pmc.email', [
            'hash' => $pmc->ShortHash(),
        ]);
    }


    public function contactForm($hash = '') {
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        return Inertia::render('Pmc/Contact', [
            'inputHash' => $pmc->ShortHash(),
            'inputData' => $pmc->Contact()->toJson(),
        ]);
    }

    public function contactSubmit(Request $request) {

        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }
        $pmc->Contact()->FillFromRequest($request);
        $pmc->Save();

        return Redirect::route('pmc.assets', [
            'hash' => $pmc->ShortHash(),
        ]);
    }



    public function assetsForm($hash = '') {
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        return Inertia::render('Pmc/Assets', [
            'hash' => $pmc->ShortHash(),
            'inputData' => $pmc->Assets()->toJson(),
            'assets' => AssetsManager::instance()->ActiveListJson(),
        ]);
    }

    public function assetsSubmit(Request $request) {
//dump($request->file('logo'));
//dump($request->file('overlay'));
//dd($request->all());
        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return Redirect::route('pmc.email');
        }

        $pmc->Assets()->FillFromRequest($request);
        $pmc->Save();

        if($cc = $pmc->Assets()->cc) {
            $cc->save();
        }

        if($cib = $pmc->Assets()->cib) {
            $cib->save();
        }

        return Redirect::route('pmc.payment', [
            'hash' => $pmc->ShortHash(),
        ]);
    }

    public function paymentForm($hash = '') {
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        if(instance()->HasPayment()) {
            return Inertia::render('Pmc/Payment', [
                'hash' => $pmc->ShortHash(),
                'inputData' => $pmc->Payment()->toJson(),
                'stripeKey' => env('STRIPE_KEY', 'pk_test_51IQKMfBI0Y0RNZhboumnKSHDttcOzEbR1ovgVyiAWbiO1hNNeie0Z7gqMap6zP1BMUnfBGl7maXY9ZcrRUR85x5q00BFQhpfPS'),
            ]);
        } else {
            $pmc->InitiateAssetsDelivery();
            return Redirect::route('pmc.calendar', ['hash' => $hash, ]);
        }
    }


    public function paymentProcessed(Request $request) {

        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Session Expired, Please Refresh Page",
            ]);
        }

        try {
            $pmc->Payment()->PaymentProcessed($request);
            $pmc->InitiateAssetsDelivery();

            return response()->json([
                'assetUrl' => '',//url("pmc/asset/download/{$pmc->Hash()}"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function paymentSubmit(Request $request) {
        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        return Redirect::route('pmc.calendar', [
            'hash' => $pmc->ShortHash(),
        ]);

    }

    public function calendarForm(Request $request, $hash = '') {
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        if(instance()->HasCalendly()) {
            $manager = $pmc->GetModel()->campaign_manager;
            $path = $pmc->GetModel()->path;
            if(!$manager) $manager = 'cr';

            if('cib' === $path) {
                $step = 'blog-interview';
                if('initial-asset-review' === $request->step) {
                    $step = 'initial-asset-review';
                }

                $calendlyUrl = "https://calendly.com/dms-partners-{$manager}/cib-{$step}";

            } else {
                $step = 'initial-asset-review';
                $calendlyUrl = "https://calendly.com/dms-partners-{$manager}/cc-{$step}";
            }


            if('http://mpc.test' === env('APP_URL')) {
                $calendlyUrl = 'https://calendly.com/azagarov/15min';
            }


            return Inertia::render('Pmc/Calendar', [
                'hash' => $pmc->ShortHash(),
//            'calendlyUrl' => env('CALENDLY_URL', 'https://calendly.com/azagarov/15min'),
                'calendlyUrl' => $calendlyUrl,
                'path' => $path,
                'step' => $step,
                'inputData' => $pmc->Calendar($step)->toJson(),
            ]);
        } else {
            return Redirect::route('pmc.thank_you', ['hash' => $hash, ]);
        }

    }


    public function calendarSubmit(Request $request) {
        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        $pmc->Calendar($request->step)->FillFromRequest($request);
        $pmc->Save();

        $path = $pmc->GetModel()->path;
        if('cib' === $path) {
            if($request->step === 'blog-interview') {
                return Redirect::route('pmc.calendar', [
                    'hash' => $pmc->ShortHash(),
                    'step' => 'initial-asset-review',
                ]);

            } else {
                return Redirect::route('pmc.thank_you', [
                    'hash' => $pmc->ShortHash(),
                ]);
            }
        } else {
            return Redirect::route('pmc.thank_you', [
                'hash' => $pmc->ShortHash(),
            ]);
        }

    }

    public function thankYou($hash = '') {
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {
            return Redirect::route('pmc.email');
        }

        return Inertia::render('Pmc/ThankYou', [
            'hash' => $pmc->ShortHash(),
            'inputData' => null,
        ]);
    }


    public function unsubscribe(Request $request) {
        return Inertia::render('Pmc/Unsubscribe', [
//            'hash' => $pmc->ShortHash(),
//            'inputData' => $pmc->Payment()->toJson(),
        ]);

    }


    public function downloadAsset($hash) {
        $pmc = PmcForm::FromHash($hash);
        if(!$pmc) abort(404);
        if(!$pmc->GetModel()->prepared_asset_url) abort(404);

        $model = $pmc->GetModel();

        $raw = json_decode($model->asset_raw);
        $extension = $raw->cloudinary_raw->format;

        $first = $str = preg_replace("/[^A-Za-z0-9]/","", $model->first_name);
        $last = $str = preg_replace("/[^A-Za-z0-9]/","", $model->last_name);

        $fileName = strtolower("{$first}_{$last}.{$extension}");

//dd($fileName);
        return response()->streamDownload(function() use ($model) {
            print file_get_contents($model->prepared_asset_url);
        }, $fileName);
    }


    public function prePaymentCheck(Request  $request) {

//        abort(419);

        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Session Expired, Please Refresh The Page',
            ]);
        }

        return response()->json([
            'ok' => true,
            'error' => '',
        ]);

    }

    public function checkToken(Request  $request) {

//        abort(419);
/*
        try {
            $pmc = PmcForm::FromShortHash($request->hash);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'error' => 'Session Expired, Please Refresh The Page',
            ]);
        }
*/
        return response()->json([
            'ok' => true,
            'error' => '',
        ]);

    }


    public function testEmail(Request  $request) {
        if($recognized = (new EmailManager())->CheckEmail((string)$request->email)) {
            return response()->json([
                'ok' => true,
                'error' => null,
                'navigation_level' => $recognized->NavigationLevel(),
                'program' => $recognized->PathNice(),
            ]);
        } else {
            return response()->json([
                'ok' => false,
                'error' => 'Email Not Found',
            ]);
        }
    }


    public function uploadImage(Request $request) {
        $file = $request->file('image');
        if(!$file) {
            abort(402);
            exit;
        }
        if(!$file->isValid()) {
            abort(402);
            exit;
        }
        if(!$file->isReadable()) {
            abort(402);
            exit;
        }

        $imageType = $request->imageType;

        $shortHash = $request->hash;
        try{
            $pmc = PmcForm::FromShortHash($shortHash);
            $dataAccess = ImageDataAccessAbstract::Create($pmc, $imageType);
        } catch (\Exception $e) {
            abort(404);
            exit;
        }

        $localFileName = "{$pmc->Hash()}_{$imageType}.{$file->getClientOriginalExtension()}";
        $localFolder = 'uploads';
        $localStorageFilePath = "{$localFolder}/{$localFileName}";

        $json = [
            'status' => 'pending',
            'local_path' => $localStorageFilePath,
            'last_touch' => date('Y-m-d H:i:s'),
        ];
        if($dataAccess->getUrl() && (new ImageChecker($dataAccess))->Check()) {
            $currentJson = $dataAccess->getJson();
            $json['old_public_id'] = $currentJson->public_id;
        }

        if(!Storage::putFileAs($localFolder, $file, $localFileName)) {
            abort(400);
            exit;
        }

        $dataAccess->updateUrl($localStorageFilePath);
        $dataAccess->updateJson($json);

        shell_exec('php '.base_path('artisan').' cld:upload-image --hash='.$pmc->Hash().' --image='.$imageType.' > /dev/null 2>/dev/null &');

        return response()->json($json);
    }
}

/*
https://res.cloudinary.com/pierry/image/upload/v1617636308/pmc/logos/linobpepjmp1ird9xzyz.jpg
 */
