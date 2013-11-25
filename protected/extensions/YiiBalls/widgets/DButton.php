<?php

class DButton extends CWidget
{
    public $buttonType;
    public $buttonStyle;
    public $type;
    public $size;
    public $label;
    public $icon;
    public $style;
    public $htmlOptions;
    public $url;

    const BUTTON_STYLE_PRETTY = 'pretty';
    const BUTTON_STYLE_METRO = 'metro';

    const TYPE_DEFAULT = 'default';
    const TYPE_PRIMARY = 'primary';
    const TYPE_SECONDARY = 'secondary';
    const TYPE_INFO = 'info';
    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_SUCCESS = 'success';

    const SIZE_SMALL = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE = 'large';
    const SIZE_X_LARGE = 'xlarge';

    const STYLE_OVAL = 'oval';
    const STYLE_ROUNDED = 'rounded';
    const STYLE_SQUARED = 'squared';
    const STYLE_PILL_LEFT = 'pill-left';
    const STYLE_PILL_RIGHT = 'pill-right';

    public function init()
    {
        $divHtmlOptions[] = 'btn';

        $validButtonStyles = array(
            self::BUTTON_STYLE_METRO,
            self::BUTTON_STYLE_PRETTY,
        );
        if (isset($this->buttonStyle) && in_array($this->buttonStyle, $validButtonStyles)) {
            $divHtmlOptions[] = $this->buttonStyle;
        }

        $validTypes = array(
            self::TYPE_DEFAULT,
            self::TYPE_PRIMARY,
            self::TYPE_SECONDARY,
            self::TYPE_SUCCESS,
            self::TYPE_WARNING,
            self::TYPE_DANGER,
            self::TYPE_INFO,
        );
        if (isset($this->type) && in_array($this->type, $validTypes)) {
            $divHtmlOptions[] = $this->type;
        }

        $validSizes = array(
            self::SIZE_SMALL,
            self::SIZE_MEDIUM,
            self::SIZE_LARGE,
            self::SIZE_X_LARGE,
        );
        if (isset($this->size) && in_array($this->size, $validSizes)) {
            $divHtmlOptions[] = $this->size;
        }

        if (isset($this->icon)) {
            $divHtmlOptions[] = $this->icon;
        }
        
        if (!isset($this->buttonType)) {
            $this->buttonType = 'submit';
        }
        $this->htmlOptions['divHtmlOptions']['class'] = implode(' ', $divHtmlOptions);
    }

    public function run()
    {
        echo $this->create();
    }

    private function create()
    {
        return DHtml::createButton($this->buttonType, $this->label, $this->htmlOptions);
    }
}
