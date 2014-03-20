<!DOCTYPE html>
<html>
<head>
	<title><?php echo($title)?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
</head>
<body>

<header>
	<h1>Admin</h1>
	<a class="header-logout" href="<?php echo base_url(); ?>index.php/user/logout">Logout</a>
</header>
<nav id="admin-nav">
	<ul>
		<a href="<?= base_url(); ?>admin/products">
			<li id="product-select" class="<?php if($nav=='products'):?>selected<?php endif?>">Products</li>
		</a>
		<a href="<?= base_url(); ?>admin/orders">
			<li class="<?php if($nav=='orders'):?>selected<?php endif?>">Orders</li>
		</a>
		<a href="<?= base_url(); ?>admin/customers">
			<li class="<?php if($nav=='customers'):?>selected<?php endif?>">Customers</li>
		</a>
	</ul>
</nav>

