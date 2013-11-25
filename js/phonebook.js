jQuery(function($) {
	$('.update').click( function (){
		$(this).siblings('.save').removeClass('hidden');
		$(this).parent().siblings().each(function (){
			var currentHtml = $(this).html();
			var newHtml = '<input id="write-change" value="'+currentHtml+'">';
			$(this).html(newHtml);
		});
		$('.save').click(function () {
			$(this).parent().siblings().each(function (){
				var newHtml = $(this).find('input').val();
				//console.log(newHtml);
				//Just update everything every time.
				$(this).empty().html(newHtml);
			});
			$(this).addClass('hidden');
			$('#grid-form').yiiGridView('update', {
                type:'POST',
                url:$(this).attr('href'),
                success:function(data) {
                      $('#grid-form').yiiGridView('update');
                }
            });
			return false;
		});
	});
});


                        