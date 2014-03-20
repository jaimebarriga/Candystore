<div class="view-product admin-content">
<h2>Product Entry</h2>
<?php 
	echo "<p class='back'>" . anchor('admin/index','Back') . "</p>";

?>
<table class="product-entry-table">
	<tr>
		<td>ID</td>
		<td><?= $product->id ?></td>
	</tr>
	<tr>
		<td>NAME</td>
		<td><?= $product->name ?></td>
	</tr>
	<tr>
		<td>DESCRIPTION</td>
		<td><?= $product->description ?></td>
	</tr>
	<tr>
		<td>PRICE</td>
		<td>$<?= $product->price ?></td>
	</tr>
	<tr>
		<td colspan="2"><?= "<p><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='150px'/></p>" ?></td>
	</tr>
</table>
</div>

