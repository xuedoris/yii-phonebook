<?php
/* @var $this SiteController */
$this->layout='home';
$this->pageTitle='Welcome to Xanadu Phonebook!';
Yii::app()->clientScript->registerCoreScript('jquery');
$jsPath = Yii::app()->baseUrl.'/js/phonebook.js';
Yii::app()->clientScript->registerScriptFile($jsPath);


// This page contains the contact list will be refreshed after each operation.-->

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'pager'=>array(
        'maxButtonCount'=>'7',
    ),
    'columns'=>array(
        'getowners.firstName',
    	'getowners.lastName',
        'phoneNumber',
        'getnumbers.phoneType'
    ),
));
