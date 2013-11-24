<?php

class DAlert extends CWidget
{
    public $type;
    public $delay;
    public $message;

    const TYPE_ERROR   = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO    = 'info';
    const TYPE_LOG     = 'log';

    public function init()
    {
        $assetsPath = Yii::getPathOfAlias('YiiBalls.assets');
        $assetsUrl  = Yii::app()->assetManager->publish($assetsPath, false, -1, false);
        $jsFile = $assetsUrl . '/alertify/js/alertify.js';
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($jsFile);

        $cssFile = $assetsUrl . '/alertify/css/alertify.core.css';
        Yii::app()->clientScript->registerCssFile($cssFile);

        $cssFile = $assetsUrl . '/alertify/css/alertify.default.css';
        Yii::app()->clientScript->registerCssFile($cssFile);
    }

    public function run()
    {
        if (!isset($this->type)) {
            $this->type = self::TYPE_INFO;
        }
        $script = '';
        switch ($this->type) {
            case self::TYPE_LOG :
                $script = $this->info();
                break;
            case self::TYPE_SUCCESS :
                $script = $this->success();
                break;
            case self::TYPE_ERROR :
                $script = $this->error();
                break;
            default:
                $script = $this->info();
                break;
        }

        Yii::app()->clientScript->registerScript('Alert:'.mt_rand(0, 10000), $script);
    }

    private function info()
    {
        return $this->generateScript(self::TYPE_LOG);
    }

    private function success()
    {
        return $this->generateScript(self::TYPE_SUCCESS);
    }

    private function error()
    {
        return $this->generateScript(self::TYPE_ERROR);
    }

    private function confirm()
    {

    }

    private function prompt()
    {

    }

    private function generateScript($type)
    {
        return sprintf('alertify.%s("%s", null, %d);', $type, $this->message, $this->delay);
    }
}
