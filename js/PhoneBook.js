/*
* Validate phone number only contains digits.
*/
$(document).ready(function() {
		$("#phone_number").keydown(function(event) {
				// Allow: backspace, delete, tab and escape
				if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
					// Allow: Ctrl+A
					(event.keyCode == 65 && event.ctrlKey === true) ||
					// Allow: home, end, left, right
					(event.keyCode >= 35 && event.keyCode <= 39)) {
					// Let it happen, don't do anything
					return;
				}
				else {
					// Ensure that it is a number and stop the keypress
					if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
						event.preventDefault();
					}
				}
		});
});

//-----------------------------INSERT---------------------------//
/*
* Insert brand-new contact.
*/
function insertNew(){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/insertNewContact", $("#newContact").serialize(),
		function(data) {
			$("#main").html(data);
		}
	)
}
/*
* Insert contact number when the name has already existed in database.
*/
function insertNumber(pid){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/insertNumberContact", $("#newContact").serialize()+"&pid= "+pid,
		function(data) {
			$("#main").html(data);
		}
	)
}
/*
* Insert contact name when the number has already existed in database.
*/
function insertName(){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/insertNameContact", $("#newContact").serialize(),
		function(data) {
			$("#main").html(data);
		}
	)
}

/*
* Insert a contact  when the name and number both has already existed in database 
* but their combination is new.
*/
function insertCombination(pid){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/insertCombination", $("#newContact").serialize()+"&pid= "+pid,
		function(data) {
			$("#main").html(data);
		}
	)
}
//--------------------------------------EDIT and SAVE-------------------------------//
/*
* Showing editing input fields.
*/
function edit(pid, number){
	$('.txt_'+pid+'_'+ number).show();
	$('.lb_'+pid+'_'+number).hide();
	$('#number_'+pid+'_'+number).keydown(function(event) {
			// Allow: backspace, delete, tab and escape
			if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
				// Allow: Ctrl+A
				(event.keyCode == 65 && event.ctrlKey === true) ||
				// Allow: home, end, left, right
				(event.keyCode >= 35 && event.keyCode <= 39)) {
				// Let it happen, don't do anything
				return;
			}
			else {
				// Ensure that it is a number and stop the keypress
				if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
					event.preventDefault();
				}
			}
	});
}

/*
* Save updated contact.
*/
function save(pid, number){
	var first, last, newNum, type, error = false;
	// Validate phone number.
	if(0 < $('#number_'+pid+'_'+number).val().length && $('#number_'+pid+'_'+number).val().length < 7){
		error = true;
		$('#invalid_num').show();
	}
	else
		$('#invalid_num').hide();
	if(!error){
		first = $('#first_'+pid+'_'+number).val();
		last = $('#last_'+pid+'_'+number).val();
		newNum = $('#number_'+pid+'_'+number).val();
		type = $('#type_'+pid+'_'+number).val();

		$.post("http://localhost/myTinyMVC/index.php/PhoneBook/updateContact",
			{id:pid, p_id:number, f:first, l:last, n:newNum, t:type},
			function(data) {
				$("#main").html(data);
			}
		)
	}
}

//-------------------------------------DELETE------------------------------//
/*
* Lauch delete operation.
*/
function deleteContact(pid, number){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/deleteCheck",{id:pid, num:number},
		function(data) {
			$("#main").html(data);
		}
	)
}

/*
* Delete the contact which its name and number are both unique.
*/
function deleteFull(pid, number){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/deleteFull",{id:pid, num:number},
		function(data) {
			$("#main").html(data);
		}
	)
}

/*
* Delete the contact which its name and its number are both not unique.
*/
function deleteCombination(pid, number){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/deleteCombination",{id:pid, num:number},
		function(data) {
			$("#main").html(data);
		}
	)
}

/*
* Delete the contact which the name is unique.
*/
function deleteName(pid, number){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/deleteName",{id:pid, num:number},
		function(data) {
			$("#main").html(data);
		}
	)
}

/*
* Delete the contact which the number is unique.
*/
function deleteNumber(pid, number){
	$.post("http://localhost/myTinyMVC/index.php/PhoneBook/deleteNumber",{id:pid, num:number},
		function(data) {
			$("#main").html(data);
		}
	)
}

//-------------------------------------SEARCH------------------------------//
/*
* Search the contact by first name or full name.
*/
function search(){
	var error = false;
	if($('#searchContent').val() == ''){
		$('#invalid_name').show();
		error = true;
	}
	else
		$('#invalid_name').hide();
	if(!error){
		$.post("http://localhost/myTinyMVC/index.php/PhoneBook/search", $("#newContact").serialize(),
			function(data) {
				$("#main").html(data);
			}
		);
	}
}

//-------------------------------------ORDER------------------------------//
/*
* Re-order the contact list by specific field.
*/
function order(field,order){
	if(field != ''){
		$.post("http://localhost/myTinyMVC/index.php/PhoneBook/order", {column:field,o:order},
			function(data) {
				$("#main").html(data);
			}
		);
	}
}