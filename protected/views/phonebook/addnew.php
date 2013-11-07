<h1>Add New Contact</h1>
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
	<p><?php echo CHtml::errorSummary($model);?></p>
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
		<?php echo CHtml::submitButton('Add contact'); ?>
		<?php /*echo CHtml::ajaxSubmitButton('Add contact',CHtml::normalizeUrl(array('phonebook/addnew','render'=>true)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         $("#formResult").html("Contact added successfully.");
                         $("#addnew-form")[0].reset();
                        } else {
                        $.each(data, function(key, val) {
                        $("#addnew-form #"+key+"_em_").text(val);                                                    
                        $("#addnew-form #"+key+"_em_").show();
                        });
                        }       
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('id'=>'mybtn','class'=>'class1 class2')); 
        */?>
		<?php echo CHtml::resetButton('Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->