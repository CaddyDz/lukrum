<?php


namespace App\utils\Pmc\Assets;



use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\Assets\Contracts\LayoutsManagerContract;
use Illuminate\Support\Collection;

class LayoutsManager implements \App\utils\Pmc\Assets\Contracts\LayoutsManagerContract
{

    const CIB_LAYOUT_CODE = 'Cib';

    public function getLayoutsList(): Collection {
        return collect(array_map(function($class) {
            return new $class;
        }, $this->layouts));
    }

    protected $layouts = [
        'Slope' => Slope\LayoutSlope::class,
        'Simple' => Simple\LayoutSimple::class,
        'Watch' => Watch\LayoutWatch::class,
        'Girl' => Girl\LayoutGirl::class,
        'Blue' => Blue\LayoutBlue::class,
    ];

    protected $cibLayout = Cib\LayoutCib::class;

    public function getLayout($code): ?LayoutContract {

        if(self::CIB_LAYOUT_CODE === $code) {
            $class = $this->cibLayout;
            return new $class;
        }

        if(!isset($this->layouts[$code])) return null;
        $class = $this->layouts[$code];
        return new $class;
    }


    /**
     * @return LayoutsManager
     */
    public static function instance(): LayoutsManagerContract {
        $currentInstanceCode = instance()->Code();
        if(!isset(self::$_instances[$currentInstanceCode])) {
            $class = instance()->LayoutsManager();
            self::$_instances[$currentInstanceCode] = new $class();
        }

        return self::$_instances[$currentInstanceCode];
    }

    private static $_instances = [];

}
