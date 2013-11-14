jQuery(function($) {
	$('.update').click( function (){
		$(this).parent().siblings().each(function (){
			var currentHtml = jQuery(this).html();
			var newHtml = '<textarea>'+currentHtml+'</textarea>';
			jQuery(this).html(newHtml);
			console.log(jQuery(this).html());
		});
	});
});
