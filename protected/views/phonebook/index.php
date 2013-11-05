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
        array(
            'name' => 'firstName',
            'value' => '$data->getowners->firstName'
        ),
        array(
            'name' => 'lastName',
            'value' => '$data->getowners->lastName'
        ),
        'phoneNumber',
        array(
            'name' => 'phoneType',
            'value' => '$data->getnumbers->phoneType',
            'filter' => array('other'=> 'Other','home' => 'Home','office' => 'Office','mobile' => 'Mobile')
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'updateButtonUrl'=>'$this->grid->controller->createUrl("update",array("id"=>$data->pId))',
            'deleteButtonUrl'=>'$this->grid->controller->createUrl("delete",array("id"=>$data->pId))'
        ),
    ),
));
