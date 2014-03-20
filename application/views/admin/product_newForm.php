<div class="add-new-product admin-content">
<h2>New Product</h2>
<?php 
	echo "<p class='back'>" . anchor('admin/index','Back') . "</p>";
	
	echo form_open_multipart('admin/createProduct');
		
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',set_value('name'),"required");

	echo form_label('Description');
	echo form_error('description');
	echo form_input('description',set_value('description'),"required");
	
	echo form_label('Price');
	echo form_error('price');
	echo form_input('price',set_value('price'),"required");
	
	echo form_label('Photo');
	
	if(isset($fileerror))
		echo $fileerror;	
?>	
	<input type="file" name="userfile" size="20" />
	<input type="submit" class="button" value="Create">
	
<?php 	
	
	echo form_close();
?>	
</div>

