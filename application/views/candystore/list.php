<h2>Products!</h2>
<div id="products">
	<ul>
		<?php foreach($products as $product): ?>
		<?php echo form_open("/candystore/add"); ?>
		<li>
			<div class="name"><?= $product->name ?></div>
			<div class="thumb"><?= "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>" ?></div>
			<div class="description"><?= $product->description ?></div>
			<div class="price">$<?= $product->price ?></div>
			<?php echo form_submit('action','Add to Cart') ?>
			<?php echo form_hidden('username', 'johndoe'); ?>
		</li>
		<?php echo form_close() ?>
		<?php endforeach ?>
	</ul>
</div>
