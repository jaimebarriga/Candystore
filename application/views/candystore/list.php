<div id="products-container">
<div id="products">
<h2>Products</h2>
	<ul>
		<?php foreach($products as $product): ?>
		<li>
		<?php echo form_open("/candystore/add"); ?>
			<div class="name"><strong><?= $product->name ?></strong></div>
			<div class="thumb"><?= "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' height='100px' /></td>" ?></div>
			<div class="description"><?= $product->description ?></div>
			<div class="price">$<?= $product->price ?></div>
			<select class="quantity" name="quantity">
				<option value="0">0</option>
				<option value="1" selected>1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>	
			</select>
			<input type="submit" class="button small" value="Add to Cart">
			<?php echo form_hidden('id', $product->id); ?>
			<?php echo form_close() ?>
		</li>
		<?php endforeach ?>
	</ul>
</div>

<?php if ($cart = $this->cart->contents()): ?>
<div id="cart">
<h3>Cart</h3>
<table class="cart-table-quick">
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach ($cart as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['qty']; ?></td>
			<td>$<?php echo $item['subtotal']; ?></td>
			<td class="remove">
				<?php echo anchor('candystore/remove/'.$item['rowid'],'X'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<tr class="total">
		<td colspan="2"><strong>Total</strong></td>
		<td colspan="2"><strong>$<?php echo $this->cart->total(); ?></strong></td>
	</tr>
</table>
<div class="view-cart">
	<a class="button" href="<?= base_url(); ?>candystore/cart">Checkout</a>
</div>	
</div>
<?php endif; ?>
</div>

