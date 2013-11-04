<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - jQuery';
$this->breadcrumbs=array(
	'jQuery zone',
);
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<h1>jQuery Play Zone</h1>

<p id="para">Quisque sem turpis, interdum ac tellus vel, vehicula tincidunt enim. Donec tincidunt vel turpis ut gravida. In in nulla tristique, porttitor sapien non, varius augue. Nam sit amet neque facilisis nunc egestas luctus sed in arcu.</p>
<button id="trigger">Trigger</button>
<script type="text/javascript">
jQuery(document).ready( function () {
	jQuery('#trigger').click( function (){
		jQuery('#para').animate({
			height: "+=50"
		}, 2000);
	});
});
</script>