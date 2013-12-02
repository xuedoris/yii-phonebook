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

	$('.save').click(function (event) {
		event.preventDefault();
		var url = $(this).attr('href');
		var ajaxData = {};
		$(this).parent().siblings().not(".phoneType").each(function (){
			var inputName = $(this).find('input').attr('name');
			ajaxData[inputName] = $(this).find('input').val();
		});
		$(this).parent().siblings(".phoneType").each(function (){
			var selectName = $(this).find('select').attr('name');
			ajaxData[selectName] = $(this).find('select').val()
		});
		console.log(ajaxData);
		$(this).addClass('hidden');
		$.post( url, ajaxData ).done(function() {
		    $("#grid-form").yiiGridView("update");
		}).fail(function() {
		    alert( "error" );
		});
		
	});
}


                        