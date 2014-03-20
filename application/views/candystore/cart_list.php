<h1 class="checkout"> Checkout </h1>

<div class="cart-container">
<?php if ($cart = $this->cart->contents()): ?>
<table class="cart-table-quick">
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
	</thead>
	<?php foreach ($cart as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['qty']; ?></td>
			<td>$<?php echo $item['subtotal']; ?></td>
		</tr>
	<?php endforeach; ?>
	<tr class="total">
		<td colspan="2"><strong>Total</strong></td>
		<td colspan="2"><strong>$<?php echo $this->cart->total(); ?></strong></td>
	</tr>
</table>
<div class="continue-shopping">
	<a href="<?= base_url() ?>candystore"><< Continue Shopping</a>
</div>
<?php endif; ?>

</div>

<div class="payment-info">

<?php echo form_open('candystore/payment'); ?>

<h5>Cardholder Name</h5>
<?php echo form_error('name','<span class="error">', '</span>'); ?>
<input type="text" name="name" value="<?php echo set_value('name') ?>" size="50">

<h5>Credit Card Number</h5>
<?php echo form_error('ccnumber','<span class="error">', '</span>'); ?>
<input type="text" name="ccnumber" value="<?php echo set_value('ccnumber'); ?>" size="16" />

<h5>Month of Expiry</h5>
<?php echo form_error('ccmonth','<span class="error">', '</span>'); ?>
<input type="text" name="ccmonth" value="<?php echo set_value('ccmonth'); ?>" size="50" />

<h5>Year of Expiry</h5>
<?php echo form_error('ccyear','<span class="error">', '</span>'); ?>
<input type="text" name="ccyear" value="<?php echo set_value('ccyear'); ?>" size="50" />

<div><input type="submit" class="button" value="Purchase" /></div>

</form>


</body>
</html>

</div>