var updateContact = function (data) {
	$(data).siblings('.save').removeClass('hidden');
	$(data).parent().siblings().not(".phoneType").each(function (){
		var currentHtml = $(this).html();
		var newHtml = '<input name="Phoneowner['+$(this).attr('class')+']" id="Phoneowner_'+$(this).attr('class')+'" value="'+currentHtml+'">';
		$(this).html(newHtml);
	});
	var selectHtml = '<select name="Phoneowner[phoneType]"><option value="other">Other</option><option value="home">Home</option><option value="office">Office</option><option value="mobile">Mobile</option></select>';
	$(data).parent().siblings(".phoneType").each(function (){
		var currentHtml = $(this).html();
		$(this).html(selectHtml);
		$(this).find('select').val(currentHtml);
		//console.log($(this));
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
}


                        