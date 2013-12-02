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
            'value' => '$data->p->firstName',
            'htmlOptions'=>array('class'=>'firstName'),
        ),
        
        array(
            'name' => 'lastName',
            'value' => '$data->p->lastName',
            'htmlOptions'=>array('class'=>'lastName'),
        ),
        array(
            'name' => 'phoneNumber',
            'value' => '$data->phone->phoneNumber',
            'htmlOptions'=>array('class'=>'phoneNumber'),
        ),
        array(
            'name' => 'phoneType',
            'value' => '$data->phone->phoneType',
            'filter' => array('other'=> 'Other','home' => 'Home','office' => 'Office','mobile' => 'Mobile'),
            'htmlOptions'=>array('class'=>'phoneType'),
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}{save}',
            'deleteButtonUrl'=>'$this->grid->controller->createUrl("delete",array("id"=>$data->pId, "phoneId"=>$data->phoneId))',
            'buttons' => array(
                'update' => array(
                    'options'=>array('onclick'=>'updateContact(this)'),
                    'url'=>'',
                ),
                'save' => array(
                    'label'=>'Save update',
                    'options'=>array('class'=>'save hidden'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/save.gif',
                    'url'=>'Yii::app()->createUrl("phonebook/update", array("id"=>$data->pId, "phoneId"=>$data->phoneId))',
                )
            ),
        ),
    ),
));
