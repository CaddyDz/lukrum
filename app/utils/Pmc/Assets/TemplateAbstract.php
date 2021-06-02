<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\TemplateRendererContract;
use App\utils\Pmc\PmcForm;

abstract class TemplateAbstract
{
    public function getPreviewHtml(): string {
        $full = $this->getFullHtml();
//dump($full);
        preg_match("/\<body\>(.*)\<\/body\>/is", $full, $m);
//        preg_match("/\<body.*\>(.*)\<\/body\>/", $full, $m);

        return $m[1];
    }

    public function getFullHtml(): string {
        return file_get_contents($this->templatePath);
    }

    public function getRenderedHtml(PmcForm $pmc): string
    {
        return $this->renderer()->Render($this, $pmc);
    }

    public function getPageFilesList(): array
    {
        $fullFilesList = array_unique(array_merge($this->commonPageFiles, $this->templatePageFiles));
        $localFolder = dirname(realpath($this->templatePath));
        return array_map(function($xPath) use ($localFolder) {
            $x = new \stdClass();
            $x->localPath = "{$localFolder}/{$xPath}";
            $x->zipPath = $xPath;
            return $x;
        }, $fullFilesList);
    }

    public function getDefaultImage():string {
        return $this->defaultImage;
    }

    protected $defaultImage = '';

    protected $commonPageFiles = [
        'css/main.css',
        'css/media.css',
        'css/main.css.map',
        'css/media.css.map',

        'fonts/Georgia.woff',
        'fonts/Georgia-Bold.woff',
        'fonts/Georgia-BoldItalic.woff',
        'fonts/Georgia-Italic.woff',
        'fonts/HelveticaNeueCyr-Medium.woff',
        'fonts/HelveticaNeueCyr-Roman.woff',
        'fonts/ITCAvantGardeStd-Bk.woff',
        'fonts/ITCAvantGardeStd-Demi.woff',
        'fonts/SalesforceSans-Bold.woff',
        'fonts/SalesforceSans-Regular.woff',
    ];

    protected $templatePageFiles = [];


    /**
     * @return TemplateRendererContract
     */
    protected function renderer(): TemplateRendererContract {
        if(!$this->_renderer) {
            $class = $this->rendererClass;
            $this->_renderer = new $class();
        }
        return $this->_renderer;
    }

    protected $_renderer;

    protected $rendererClass;

    protected $templatePath;
}
