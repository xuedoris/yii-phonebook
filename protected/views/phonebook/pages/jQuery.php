<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - jQuery';
$this->breadcrumbs=array(
	'jQuery zone',
);
Yii::app()->clientScript->registerCoreScript('jquery');
$cssPath = Yii::app()->baseUrl.'/css/jQuery.css';
Yii::app()->clientScript->registerCSSFile($cssPath);
?>
<h1>jQuery Play Zone</h1>
<p id="para">This page is for Xueyuan to learn and practice jQuery.</p>
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

<button id="trigger">Trigger</button>
<input type="button" id="clickable" value="Clickable in 10 seconds"/>
<div class="change">
Write and Change
</div>
<script type="text/javascript">
jQuery(document).ready( function () {
	jQuery('#trigger').click( function (){
		
	});

	/**Write and Change**/
	jQuery('.change').dblclick( function (){
		var currentHtml = jQuery(this).html();
		var inputHtml = '<textarea id="write-change">'+currentHtml+'</textarea>';
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