<?php
/* @var $this SiteController */
$this->layout='home';
$this->pageTitle='Welcome to Xanadu Phonebook!';
Yii::app()->clientScript->registerCoreScript('jquery');
$jsPath = Yii::app()->baseUrl.'/js/phonebook.js';
Yii::app()->clientScript->registerScriptFile($jsPath);


// This page contains the contact list will be refreshed after each operation.-->
print_r($model->phonenumbers);
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grid-view',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'pager'=>array(
        'maxButtonCount'=>'7',
    ),
    'columns'=>array(
    	'firstName',
    	'lastName',
        array('name'=>'phonenumbers.phoneNumber', 'value'=>$model->phonenumbers->phoneNumber),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),	
    ),
));*/
