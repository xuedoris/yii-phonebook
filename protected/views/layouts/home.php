<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-6 left">
	<div id="sidebar">
		<div id = "new_contact">
			<h4>Add New Contact</h4>
			<div id = "exist"></div>
			<form name="newContact" id = "newContact" action="" method="post" >
			First name:<input name="fname" id = "fname">
			<p id="lb_fname">you have to enter first name</p>
			Last name:<input name="lname" id = "lname">
			<p id="lb_lname">you have to enter last name</p>
			Phone number:<input name="phone_number" id = "phone_number" >
			<p id="invalid_number">The number is NOT valid. Please enter at least 7 digits number.</p>
			Phone type:
			<select name = "phone_type">
				<option value = "home">Home</option>
				<option value = "mobile">Mobile</option>
				<option value = "office">Office</option>
				<option value = "other">Other</option>
			</select>
			<a href="javascript:validate()" class="button">Add contact</a>
			<input type = "reset" id = "reset" value = "Reset">
		</div>

		<div id = "search">
			<h4>Search Contact</h4>
			<form name="searchBox" id = "searchBox" action="" method="post" >
			By name:
			<input name="searchContent" id = "searchContent">
			<p id="invalid_name">The name is NOT valid. Ex.Dara Pich</p>
			<a href="javascript:search()" class="button">Search</a>
		</div>
	</div><!-- sidebar -->
</div>
<div class="span-16">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>