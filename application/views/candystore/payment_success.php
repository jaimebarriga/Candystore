<div class="payment-content">

<h2 class="payment-success">
	Payment Success!!
</h2>

<div class='receipt'>
	<div class='store-name-receipt'>
	Candy Store
	</div>
	<div class='date'>
		<?= date('Y-m-d H:i:s') ?>
	</div>
	<table class="receipt-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($cart as $item): ?>
		<tr>
			<td><?= $item['name'] ?></td>
			<td><?= $item['qty'] ?></td>
			<td><?= $item['subtotal'] ?></td>
		</tr>
		<?php endforeach ?>
		<tr>
			<td colspan='2'><strong>Total</strong></td>
			<td>$<?php echo $this->cart->total(); ?></td>
		</tr>
		</tbody>
	</table>
	<div class='come-again'>
		<br>
		HOPE YOU SHOP <br>WITH US AGAIN!
	</div>
</div>

<br><br>

<a href="<?= base_url(); ?>candystore" class="button">Keep Shopping</a>
<div class="button" onclick="printreceipt()">Print Receipt</div>

<script>
function printreceipt() {
 top.wRef=window.open('','myconsole',
  'width=500,height=450,left=10,top=10'
   +',menubar=1'
   +',toolbar=0'
   +',status=1'
   +',scrollbars=1'
   +',resizable=1')
 top.wRef.document.writeln(
  '<html><head><title>Receipt</title></head>'
 +'<style>@import url(http://fonts.googleapis.com/css?family=Source+Code+Pro);.payment-content {text-align: center;}'
 +'.receipt{padding: 10px;display: inline-block;font-family: "Source Code Pro";border: 1px solid #333;'
 +'margin-top: 10px;}.receipt .store-name-receipt {text-transform: uppercase;text-align: center;}.receipt .date {'
 +'text-align: center;margin: 10px 0;}.receipt-table {margin: 0 auto;}.receipt-table td, .recepit-table th {'
 +'padding: 10px;}</style>'
 +'<body><p style="text-align:center;">Press Command+P or Ctrl+P to print</p>'
 +'<div class="payment-content">'
 +"<div class='receipt'><div class='store-name-receipt'>Candy Store</div>"
 +"<div class='date'><?= date('Y-m-d H:i:s') ?></div><table class='receipt-table'>"
 +"<thead><tr><th>Name</th><th>Quantity</th><th>Subtotal</th></tr></thead>"
 +"<tbody><?php foreach($cart as $item): ?><tr><td><?= $item['name'] ?></td>"
 +"<td><?= $item['qty'] ?></td><td><?= $item['subtotal'] ?></td></tr><?php endforeach ?>"
 +"<tr><td colspan='2'><strong>Total</strong></td><td>$<?php echo $this->cart->total(); ?></td>"
 +"</tr></tbody></table><div class='come-again'><br>HOPE YOU SHOP <br>WITH US AGAIN!"
 +"</div></div></div>"
 )
 top.wRef.document.writeln('</body></html>')
 top.wRef.document.close()
}
//-->


</script>

</div>