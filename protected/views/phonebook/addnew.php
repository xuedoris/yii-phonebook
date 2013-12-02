<h3>Add New Contact</h3>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addnew-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation' => true,
	'action' => $this->createUrl( 'phonebook/addnew' ),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<p><?php echo $form->errorSummary($model);?></p>
	<div class="errorMessage" id="formResult"><ul></ul></div>
	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName'); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName'); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'phoneNumber'); ?>
		<?php echo $form->textField($model,'phoneNumber'); ?>
		<?php echo $form->error($model,'phoneNumber'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'phoneType'); ?>
		<?php 
			echo $form->dropDownList($model,
				'phoneType', 
				array('other' => 'Other', 'home' => 'Home', 'mobile' => 'Mobile', 'office' => 'Office')
			); 
		?>
		<?php echo $form->error($model,'phoneType'); ?>
	</div>

	<div class="row buttons">
		<?php //secho CHtml::submitButton('Add contact'); ?>
		<?php echo CHtml::ajaxSubmitButton('Add contact',CHtml::normalizeUrl(array('phonebook/addnew','render'=>true)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();
                         
                        if(data && data.status=="success"){
	                        $("#formResult").html("Contact added successfully.");
	                        $("#addnew-form")[0].reset();
	                        $("#grid-form").yiiGridView("update");
                        } else {
	                        $.each(data, function(key, val) {
	                        	$("#formResult").html("<li>"+val+"</li>");
	                        });
                        }   
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('id'=>'mybtn','class'=>'class1 class2')); 
        ?>
		<?php echo CHtml::resetButton('Reset'); ?>
		<div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif"></img></div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->