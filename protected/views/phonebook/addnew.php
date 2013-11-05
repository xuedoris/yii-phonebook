<h1>Add New Contact</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addnew-form',
	'enableClientValidation'=>true,
	'action' => $this->createUrl( 'phonebook/index' ),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
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
		<?php echo CHtml::resetButton('Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->