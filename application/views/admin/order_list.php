<div class="order-list admin-content">
<h2>Order Table</h2>
<?php 
 		echo "<table class='product-table'>";
		echo "<thead><tr><th>ID</th><th>Customer ID</th><th>Order Date</th><th>Total</th></tr></thead>";
		
		foreach ($orders as $order) {
			echo "<tr class='table-row'>";
			echo "<td>" . $order->id . "</td>";
			echo "<td>" . $order->customer_id . "</td>";
			echo "<td>" . $order->order_date . " ". $order->order_time . "</td>";
			echo "<td>$" . $order->total ."</td>";
			echo "</tr>";
		}
		echo "<table>";
?>	
</div>