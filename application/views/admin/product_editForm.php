<div class="update-product admin-content">
<h2>Edit Product</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p class='back'>" . anchor('admin/index','Back') . "</p>";
	
	echo form_open("admin/updateProduct/$product->id");
	
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',$product->name,"required");

	echo form_label('Description');
	echo form_error('description');
	echo form_input('description',$product->description,"required");
	
	echo form_label('Price');
	echo form_error('price');
	echo form_input('price',$product->price,"required");
	
	echo "<input type='submit' class='button' value='Save'>";
	echo form_close();
?>	
</div>

