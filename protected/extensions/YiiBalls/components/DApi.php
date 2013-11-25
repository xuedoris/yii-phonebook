<?php

class DApi extends CApplicationComponent
{
    /**
     * @var int static counter, used for determining script identifiers
     */
    public static $counter = 0;

    /**
     * @var bool whether we should copy the asset file or directory even if it is already published before.
     */
    public $forceCopyAssets = false;

    private $_assetsUrl;

    /**
     * Registers the Bootstrap CSS.
     * @param string $url the URL to the CSS file to register.
     */
    public function registerCoreCss($url = null)
    {
        if ($url === null) {
            $fileName = 'gumby.css';
            $url = $this->getAssetsUrl() . '/gumby/css/' . $fileName;
        }
        Yii::app()->clientScript->registerCssFile($url);
    }

    public function registerModernizrScript($url = null, $position = CClientScript::POS_END)
    {
        if ($url === null) {
            $fileName = 'modernizr-2.6.2.min.js';
            $url = $this->getAssetsUrl() . '/gumby/js/libs/' . $fileName;
        }

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($url, $position);
    }

    public function registerCoreScript($url = null, $position = CClientScript::POS_END)
    {
        if ($url === null) {
            $fileName = 'gumby.js';
            $url = $this->getAssetsUrl() . '/gumby/js/libs/' . $fileName;
        }

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($url, $position);
    }

    public function registerInitScript($url = null, $position = CClientScript::POS_END)
    {
        if ($url === null) {
            $fileName = 'gumby.init.js';
            $url = $this->getAssetsUrl() . '/gumby/js/libs/' . $fileName;
        }

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($url, $position);
    }

    public function registerAllScripts()
    {
        $this->registerModernizrScript();
        $this->registerCoreScript();
        $this->registerInitScript();
    }
    /**
     * Registers all assets.
     */
    public function register()
    {
        $this->registerCoreCss();
        $this->registerAllScripts();
    }

    /**
     * Returns the url to the published assets folder.
     * @return string the url.
     */
    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            $assetsPath = Yii::getPathOfAlias('YiiBalls.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}
