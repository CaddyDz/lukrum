<?php


namespace App\utils\Pmc\EmailManager;


use App\utils\Pmc\EmailManager\Contracts\EmailsProviderContract;
use App\utils\Pmc\EmailManager\Contracts\RecognizedEmailAddressContract;

class EmailManager implements Contracts\EmailManagerContract
{

    public function CheckEmail(string $email): ?RecognizedEmailAddressContract
    {
        foreach($this->providers as $pClass) {
            $provider = new $pClass();
            /**
             * @var EmailsProviderContract $provider
             */
            if($recognized = $provider->Check($email)) {
                return $recognized;
            }
        }
        return null;
    }

    private $providers = [
        EmailProviderDB::class,
        EmailProviderCsv::class,
    ];

    static public function NicePath(string $input): string {
        return self::$nicePathList[$input] ?? $input;
    }

    static private $nicePathList = [
        'cc' => 'Custom Creative',
        'cib' => 'Campaign-in-a-Box',
    ];
}
