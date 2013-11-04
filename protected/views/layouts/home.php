<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="span-6 left">
	<div id="sidebar">
		<?php $this->renderPartial('/phonebook/addnew', array('model'=>new Phoneowner)); ?>
	</div><!-- sidebar -->
</div>
<div class="span-16">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>