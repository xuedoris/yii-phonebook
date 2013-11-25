<?php

Yii::import('YiiBalls.helpers.DHtml');

class DActiveForm extends CActiveForm
{
    public function textField($model, $attribute, $htmlOptions = array())
    {
        return DHtml::createTextField($model, $attribute, $htmlOptions);
    }

    public function passwordField($model, $attribute, $htmlOptions = array())
    {
        return DHtml::createPasswordField($model, $attribute, $htmlOptions);
    }

    public function checkBox($model, $attribute, $htmlOptions = array())
    {
        return DHtml::createCheckBox($model, $attribute, $htmlOptions);
    }

    public function checkBoxList($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return DHtml::createCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    public function dropDownList($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return DHtml::createDropDownList($model, $attribute, $data, $htmlOptions);
    }
}
