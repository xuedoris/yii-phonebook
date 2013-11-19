jQuery(function($) {
	$('.update').click( function (){
		//alert('here');
		$(this).parent().siblings().each(function (){
			var currentHtml = $(this).html();
			var newHtml = '<input value="'+currentHtml+'" />';
			$(this).html(newHtml);
			//console.log(jQuery(this).html());
		});
	});
});
