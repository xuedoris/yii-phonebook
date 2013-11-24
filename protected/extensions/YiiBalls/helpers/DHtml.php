<?php
/**
 * DHtml is a static class that provides a collection of helper methods for creating HTML views.
 *
 * @author dara pich <darapich@outlook.com>
 */

class DHtml extends CHtml
{
    const BUTTON_TYPE_SUBMIT = 'submit';
    const BUTTON_TYPE_BUTTON = 'button';
    const BUTTON_TYPE_RESET = 'reset';
    const BUTTON_TYPE_LINK = 'link';

    const INPUT_TEXT_FIELD = 'textField';
    const INPUT_PASSWORD_FIELD = 'passwordField';
    const INPUT_DROP_DOWN_LIST = 'dropdown';
    const INPUT_CHECKBOX_LIST = 'checkbox';

    public static function createButton($type = 'submit', $label = 'button', $htmlOptions = array())
    {
        $divHtmlOptions = array();
        if (isset($htmlOptions['divHtmlOptions'])) {
            $divHtmlOptions = $htmlOptions['divHtmlOptions'];
            unset($htmlOptions['divHtmlOptions']);
        }
        
        $html = self::openTag('div', $divHtmlOptions);
        $html .= self::buttonType($type, $label, $htmlOptions);
        $html .= self::closeTag('div');
        return $html;
    }

    public static function buttonType($type = 'submit', $label = 'button', $htmlOptions = array())
    {
        switch ($type) {
            case self::BUTTON_TYPE_SUBMIT :
                return CHtml::submitButton($label, $htmlOptions);
                break;
            case self::BUTTON_TYPE_BUTTON :
                return CHtml::htmlButton($label, $htmlOptions);
                break;
            case self::BUTTON_TYPE_RESET :
                break;
            case self::BUTTON_TYPE_LINK :
                return CHtml::linkButton($label, $htmlOptions);
                break;
        }
    }

    public static function createTextField($model, $attribute, $htmlOptions = array())
    {
        return self::createInputField(self::INPUT_TEXT_FIELD, $model, $attribute, $htmlOptions);
    }

    public static function createPasswordField($model, $attribute, $htmlOptions = array())
    {
        return self::createInputField(self::INPUT_PASSWORD_FIELD, $model, $attribute, $htmlOptions);
    }

    public static function createCheckBox($model, $attribute, $htmlOptions = array())
    {

    }

    public static function createCheckBoxList($model, $attribute, $htmlOptions = array(), $data = array())
    {
        return self::createInputField(self::INPUT_CHECKBOX_LIST, $model, $attribute, $htmlOptions, $data);
    }

    public static function createDropDownList($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::createInputField(self::INPUT_DROP_DOWN_LIST, $model, $attribute, $htmlOptions, $data);
    }

    public static function createInputField($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $input = '';
        $label = '';
        $divHtmlOptions = array();
        $labelHtmlOptions = array();
        
        if (isset($htmlOptions['divHtmlOptions'])) {
            $divHtmlOptions = $htmlOptions['divHtmlOptions'];
            unset($htmlOptions['divHtmlOptions']);
        }
        if (isset($htmlOptions['labelHtmlOptions'])) {
            $divHtmlOptions = $htmlOptions['labelHtmlOptions'];
            unset($htmlOptions['labelHtmlOptions']);
        }
        
        switch ($type) {
            case self::INPUT_TEXT_FIELD :
                if (isset($divHtmlOptions['prepend'])) {
                    $divHtmlOptions['class'] .= ' prepend';
                    $input .= self::tag('span', array('class' => 'adjoined'), $divHtmlOptions['prepend']);
                    unset($divHtmlOptions['prepend']);
                }
                $input .= CHtml::activeTextField($model, $attribute, $htmlOptions);
                if (isset($divHtmlOptions['append'])) {
                    $divHtmlOptions['class'] .= ' append';
                    $input .= self::tag('span', array('class' => 'adjoined'), $divHtmlOptions['append']);
                    unset($divHtmlOptions['append']);
                }
                $label = self::activeLabel($model, $attribute, $labelHtmlOptions);
                break;
            case self::INPUT_PASSWORD_FIELD :
                $label = self::activeLabel($model, $attribute, $labelHtmlOptions);
                $input = CHtml::activePasswordField($model, $attribute, $htmlOptions);
                break;
            case self::INPUT_DROP_DOWN_LIST :
                $input = CHtml::activeDropDownList($model, $attribute, $data, $htmlOptions);
                break;
            case self::INPUT_CHECKBOX_LIST :
                $input = self::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
                break;
        }
        $div = self::openTag('div', $divHtmlOptions);

        $closeDiv = self::closeTag('div');
        return $div . $label . $input . $closeDiv;
    }

    public static function activeCheckBoxList($model,$attribute,$data,$htmlOptions=array())
    {
        self::resolveNameID($model,$attribute,$htmlOptions);
        $selection=self::resolveValue($model,$attribute);
        if($model->hasErrors($attribute))
            self::addErrorCss($htmlOptions);
        $name=$htmlOptions['name'];
        unset($htmlOptions['name']);

        if(array_key_exists('uncheckValue',$htmlOptions))
        {
            $uncheck=$htmlOptions['uncheckValue'];
            unset($htmlOptions['uncheckValue']);
        }
        else
            $uncheck='';

        $hiddenOptions=isset($htmlOptions['id']) ? array('id'=>self::ID_PREFIX.$htmlOptions['id']) : array('id'=>false);
        $hidden=$uncheck!==null ? self::hiddenField($name,$uncheck,$hiddenOptions) : '';

        return self::checkBoxList($name,$selection,$data,$htmlOptions);
    }

    public static function checkBoxList($name,$select,$data,$htmlOptions=array())
    {
        $template=isset($htmlOptions['template'])?$htmlOptions['template']:'{beginLabel} {input} {span} {labelTitle} {endLabel}';
        $separator=isset($htmlOptions['separator'])?$htmlOptions['separator']:"<br/>\n";
        $container=isset($htmlOptions['container'])?$htmlOptions['container']:'span';
        unset($htmlOptions['template'],$htmlOptions['separator'],$htmlOptions['container']);

        if(substr($name,-2)!=='[]')
            $name.='[]';

        if(isset($htmlOptions['checkAll']))
        {
            $checkAllLabel=$htmlOptions['checkAll'];
            $checkAllLast=isset($htmlOptions['checkAllLast']) && $htmlOptions['checkAllLast'];
        }
        unset($htmlOptions['checkAll'],$htmlOptions['checkAllLast']);

        $labelOptions=isset($htmlOptions['labelOptions'])?$htmlOptions['labelOptions']:array('class' => 'checkbox');
        unset($htmlOptions['labelOptions']);

        $items=array();
        $baseID=isset($htmlOptions['baseID']) ? $htmlOptions['baseID'] : self::getIdByName($name);
        unset($htmlOptions['baseID']);
        $id=0;
        $checkAll=true;

        foreach($data as $value=>$labelTitle)
        {
            $checked=!is_array($select) && !strcmp($value,$select) || is_array($select) && in_array($value,$select);
            $checkAll=$checkAll && $checked;
            $htmlOptions['value']=$value;
            $htmlOptions['id']=$baseID.'_'.$id++;
            $option=self::checkBox($name,$checked,$htmlOptions);
            $beginLabel=self::openTag('label',$labelOptions);
            $endLabel=self::closeTag('label');
            $items[]=strtr($template,array(
                '{beginLabel}' => $beginLabel,
                '{input}'=>$option,
                '{span}' => self::openTag('span').self::closeTag('span'),
                '{labelTitle}'=>$labelTitle,
                '{endLabel}'=>$endLabel,
            ));
        }

        if(isset($checkAllLabel))
        {
            $htmlOptions['value']=1;
            $htmlOptions['id']=$id=$baseID.'_all';
            $option=self::checkBox($id,$checkAll,$htmlOptions);
            $beginLabel=self::openTag('label',$labelOptions);
            $label=self::label($checkAllLabel,$id,$labelOptions);
            $endLabel=self::closeTag('label');
            $item=strtr($template,array(
                '{input}'=>$option,
                '{beginLabel}'=>$beginLabel,
                '{label}'=>$label,
                '{labelTitle}'=>$checkAllLabel,
                '{endLabel}'=>$endLabel,
            ));
            if($checkAllLast)
                $items[]=$item;
            else
                array_unshift($items,$item);
            $name=strtr($name,array('['=>'\\[',']'=>'\\]'));
            $js=<<<EOD
jQuery('#$id').click(function() {
	jQuery("input[name='$name']").prop('checked', this.checked);
});
jQuery("input[name='$name']").click(function() {
	jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
});
jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
EOD;
            $cs=Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerScript($id,$js);
        }
        return implode(' ',$items);
    }
}
