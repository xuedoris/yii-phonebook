<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - jQuery';
$this->breadcrumbs=array(
	'jQuery zone',
);
Yii::app()->clientScript->registerCoreScript('jquery');
$cssPath = Yii::app()->baseUrl.'/css/jQuery.css';
Yii::app()->clientScript->registerCSSFile($cssPath);
Yii::app()->YiiBalls->register();
?>
<h1>jQuery Play Zone</h1>
<button id="trigger">Trigger</button>
<p id="para">This page is for Xueyuan to learn and practice jQuery. Curabitur risus nisi, tempus vitae tortor et, dignissim malesuada erat. Ut blandit condimentum ligula, non pharetra lorem laoreet a. Duis volutpat orci a dolor ultricies sollicitudin. Nunc sollicitudin mattis ipsum non blandit.</p>
<div class="grid-view">
<table class="items">
	<thead>
	<tr>
		<th>Header 1</th>
		<th>Header 2</th>
	</tr>
	</thead>
<tr>
<td>row 1, cell 1</td>
<td>row 1, cell 2</td>
</tr>
<tr>
<td>row 2, cell 1</td>
<td>row 2, cell 2</td>
</tr>
<tr>
<td>row 3, cell 1</td>
<td>row 3, cell 2</td>
</tr>
<tr>
<td>row 4, cell 1</td>
<td>row 4, cell 2</td>
</tr>
<tr>
<td>row 5, cell 1</td>
<td>row 5, cell 2</td>
</tr>
<tr>
<td>row 6, cell 1</td>
<td>row 6, cell 2</td>
</tr>
</table>
</div>

<input type="button" id="clickable" value="Clickable in 10 seconds"/>
<div class="change">
Write and Change
</div>
<?php
$this->widget('YiiBalls.widgets.DButton', array(
'buttonStyle' => 'pretty',
'type' => 'success',
'size' => 'large',
'label' => 'Save',
'icon' => 'ok',
));
?>
<script type="text/javascript">
jQuery(document).ready( function () {
	jQuery('#trigger').click( function (){
		jQuery('#para').stop().slideToggle(1000);
	});

	/**Write and Change**/
	jQuery('.change').dblclick( function (){
		var currentHtml = jQuery(this).html();
		var inputHtml = '<input id="write-change" value="'+currentHtml+'">';
		jQuery(this).empty().html(inputHtml);
		jQuery('#write-change').blur( function () {
			jQuery(this).addClass('blur');
			var newHtml = jQuery(this).val();
			jQuery(this).parent().empty().html(newHtml);
		});
	});
	/*****/

	jQuery('table.items tr:odd').addClass('zebra');
	jQuery('table.items tr').hover(
	  function() {
	    jQuery(this).addClass('highlight');
	  }, function() {
	    jQuery(this).removeClass('highlight');
	  }
	);
	/* Clickable after 10 seconds */
	var target = jQuery('#clickable');
	countDown = function(seconds){
		if(seconds == 0){
			target.val('Clickable Now!');
			target.removeAttr('disabled');
			return;
		} else {
			setTimeout(function(){
				seconds--;
				target.val('Clickable in '+seconds.toString()+' seconds');
				countDown(seconds);
			},1000);
		}
	}
	jQuery('#clickable').attr('disabled','disabled');
	countDown(10);
});
</script>