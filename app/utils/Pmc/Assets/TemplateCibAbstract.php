<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\TemplateCibContract;
use App\utils\Pmc\Assets\Contracts\TemplateRendererContract;

abstract class TemplateCibAbstract extends TemplateAbstract implements TemplateCibContract
{
    public function SetTouchPoint(string $touchPointCode): TemplateCibContract {
        $this->touchPointCode = $touchPointCode;
        return $this;
    }

    protected $touchPointCode;


    /**
     * @return TemplateRendererContract
     */
    protected function renderer(): TemplateRendererContract {
        if(!$this->_renderer) {
            $class = $this->rendererClass;
            $this->_renderer = new $class($this->touchPointCode);
        }
        return $this->_renderer;
    }

}
