<div class="product-list admin-content">
<h2>Product Table</h2>
<?php 
		echo "<div class='add-new button'>" . anchor('admin/newproduct','Add New') . "</div>";
 	  
		echo "<table class='product-table'>";
		echo "<thead><tr><th>Photo</th><th>Name</th><th>Description</th><th>Price</th><th></th><th></th><th></th></tr></thead>";
		
		foreach ($products as $product) {
			echo "<tr class='table-row'>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>$" . $product->price . "</td>";
				
			echo "<td>" . anchor("admin/deleteProduct/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "<td>" . anchor("admin/editProduct/$product->id",'Edit') . "</td>";
			echo "<td>" . anchor("admin/readProduct/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "<table>";
?>	
</div>

