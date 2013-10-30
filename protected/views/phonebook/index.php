<?php
/* @var $this SiteController */
$this->layout='home';
$this->pageTitle='Welcome to Xanadu Phonebook!';
Yii::app()->clientScript->registerCoreScript('jquery');
$jsPath = Yii::app()->baseUrl.'/js/phonebook.js';
Yii::app()->clientScript->registerScriptFile($jsPath);


// This page contains the contact list will be refreshed after each operation.-->
print_r($model->displayAll());
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grid-view',
    'dataProvider'=>$model->displayAll(),
    'filter'=>$model,
    'htmlOptions'=>array('style'=>'width:740px'),
    'pager'=>array(
        'maxButtonCount'=>'7',
    ),
    'columns'=>array(
    	'firstName',
    	'lastName',
    	array(
            'name'=>'number',
            'value'=>'$data->country->name'
        ),
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'$this->grid->controller->createReturnableUrl("view",array("id"=>$data->id))',
            'updateButtonUrl'=>'$this->grid->controller->createReturnableUrl("update",array("id"=>$data->id))',
            'deleteButtonUrl'=>'$this->grid->controller->createReturnableUrl("delete",array("id"=>$data->id))',
            'deleteConfirmation'=>Yii::t('ui','Are you sure to delete this item?'),
        ),
    ),
));*/
