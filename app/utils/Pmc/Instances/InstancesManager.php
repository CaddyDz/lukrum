<?php


namespace App\utils\Pmc\Instances;


class InstancesManager
{

    const DEFAULT_DOMAIN = 'default';
    const DEFAULT_CODE = 'default';

    public function current(): \App\utils\Pmc\Instances\Contracts\InstanceContract {
        if(!$this->currentInstance) {
            $code = $this->currentCode();
            if(self::DEFAULT_CODE === $code) {
                $class = self::$defaultInstance;
            } else {
                $class = self::$codes[$code];
            }
            $this->currentInstance = new $class();
        }
        return $this->currentInstance;
    }
    /**
     * @var \App\utils\Pmc\Instances\Contracts\InstanceContract
     */
    private $currentInstance;

    public function code($instanceCode): \App\utils\Pmc\Instances\Contracts\InstanceContract {
        if(!isset($this->byCodeCache[$instanceCode])) {
            if(isset(self::$codes[$instanceCode])) {
                $class = self::$codes[$instanceCode];
            } else {
                $class = self::$defaultInstance;
            }
            $this->byCodeCache[$instanceCode] = new $class();
        }
        return $this->byCodeCache[$instanceCode];
    }

    private $byCodeCache = [];

    private function currentCode():string {
        if(!$this->currentCode) {
            $domain = $this->domain();
            if(self::DEFAULT_DOMAIN === $domain) {
                $this->currentCode = self::DEFAULT_CODE;
            } else {
                $this->currentCode = self::$domains[$domain];
            }
        }
        return $this->currentCode;
    }

    private $currentCode;

    private function domain(): string {
        if(!$this->currentDomain) {
            $this->currentDomain = self::DEFAULT_DOMAIN;
            if($httpDomain = request()->getHttpHost()) {
                if(array_key_exists($httpDomain, self::$domains)) {
                    $this->currentDomain = $httpDomain;
                }
            }
        }

        return $this->currentDomain;
    }

    private $currentDomain;

    public function forceDomain(string $domain = null): InstancesManager {
        $this->currentDomain = $domain;
        $this->currentCode = null;
        $this->currentInstance = null;

        return $this;
    }

    public function forceCode(string $code = null): InstancesManager {
        $this->currentCode = $code;
        $this->currentDomain = null;
        $this->currentInstance = null;

        return $this;
    }

    private static $domains = [
        'demo.mpc.test' => 'demo',
        'demo.dms.partners' => 'demo',
        'lukrum.com' => 'demo',
        'stg.app.lukrum.com' => 'demo',
        'app.lukrum.com' => 'demo',
        'demo.lukrum.com' => 'demo',
        'webfreediver.asuscomm.com:667' => 'demo',
        '127.0.0.1:8000' => 'demo',
    ];

    private static $codes = [
        'demo' => \App\utils\Pmc\Instances\Demo\InstanceDemo::class,
    ];

    private static $defaultInstance = \App\utils\Pmc\Instances\DefaultOne\InstanceDefault::class;


    /**
     * @return InstancesManager
     */
    public static function instance(): InstancesManager {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @var InstancesManager
     */
    private static $_instance;
}
