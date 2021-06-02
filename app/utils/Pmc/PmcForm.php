<?php


namespace App\utils\Pmc;


use App\Models\PmcForm as Model;
use App\utils\Pmc\FormParts\FormPartAssets;
use App\utils\Pmc\FormParts\FormPartCalendar;
use App\utils\Pmc\FormParts\FormPartContact;
use App\utils\Pmc\FormParts\FormPartEmail;
use App\utils\Pmc\FormParts\FormPartPayment;

class PmcForm
{

    /**
     * @return PmcForm
     */
    public static function CreateNew() {
        $instance = new self();
        $instance->_makeEmpty();
        return $instance;
    }

    /**
     * @param Model $model
     * @return PmcForm
     */
    public static function FromModel(Model $model) {
        $instance = new self();
        $instance->model = $model;

        return $instance;
    }

    public static function FromHash($hash) {
        try {
            $model = Model::where('hash', $hash)->firstOrFail();
        } catch (\Exception $e) {
            $model = new Model();
            $model->hash = $hash;
            $model->instance = instance()->Code();
        }
        return self::FromModel($model);
    }

    public static function FromShortHash($shortHash) {
        $hash = session("pmc_hash.{$shortHash}");
        if(!$hash) throw new \Exception("Unknown Short Hash");
        return self::FromHash($hash);
    }

    public function Hash() {
        return $this->model->hash;
    }

    private function __construct()
    {
    }

    public function ShortHash() {
        return substr($this->model->hash,  6, 6);
    }

    private function _makeEmpty() {
        $this->model = new Model();
        $this->model->hash = $this->_generateHash();
        $this->model->instance = instance()->Code();

        session(["pmc_hash.{$this->ShortHash()}" => $this->model->hash, ]);
    }

    private function _generateHash() {
        return md5(time().'_'.rand(0, 500).'_'.rand(0, 400).'_*ANGRA*_'.time());
    }

    /**
     * @return FormPartEmail
     */
    public function Email() {
        if(!$this->email) {
            $this->email = FormPartEmail::FromModel($this->model);
        }
        return $this->email;
    }

    /**
     * @return FormPartContact
     */
    public function Contact() {
        if(!$this->contact) {
            $this->contact = FormPartContact::FromModel($this->model);
        }
        return $this->contact;
    }

    /**
     * @return FormPartAssets
     */
    public function Assets() {
        if(!$this->assets) {
            $this->assets = FormPartAssets::FromModel($this->model);
        }
        return $this->assets;
    }

    /**
     * @param string $step
     * @return FormPartCalendar
     */
    public function Calendar($step = 'initial-asset-review') {
        if(!$this->calendar) {
            $this->calendar = FormPartCalendar::FromModel($this->model);
        }
        $this->calendar->setStep($step);
        return $this->calendar;
    }

    /**
     * @return FormPartPayment
     */
    public function Payment() {
        if(!$this->payment) {
            $this->payment = FormPartPayment::FromModel($this->model);
        }
        return $this->payment;
    }


    public function Save() {
        return $this->model->save();
    }

    /**
     * @return Model
     */
    public function GetModel() {
        return $this->model;
    }

    private $email;
    private $contact;
    private $assets;
    private $calendar;
    private $payment;

    /**
     * @var Model
     */
    private $model;

    public function InitiateAssetsDelivery() {
        shell_exec('php '.base_path('artisan').' deliver:assets --hash='.$this->model->hash.' > /dev/null 2>/dev/null &');
    }
}
