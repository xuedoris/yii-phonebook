<?php
/* @var $this SiteController */
$this->layout='home';
$this->pageTitle='Welcome to Xanadu Phonebook!';
Yii::app()->clientScript->registerCoreScript('jquery');
$jsPath = Yii::app()->baseUrl.'/js/phonebook.js';
Yii::app()->clientScript->registerScriptFile($jsPath);

// This page contains the contact list will be refreshed after each operation.-->

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grid-form',
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
            'template'=>'{update}{delete}{save}',
            'updateButtonUrl'=>'',
            'deleteButtonUrl'=>'$this->grid->controller->createUrl("delete",array("id"=>$data->pId, "number"=>$data->phoneNumber))',
            'buttons' => array(
                'save' => array(
                    'label'=>'Save update',
                    'options'=>array('class'=>'save hidden'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/save.gif',
                    'url'=>'Yii::app()->createUrl("phonebook/update", array("id"=>$data->pId))',
                )
            ),
        ),
    ),
));
