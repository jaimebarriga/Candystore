<!DOCTYPE html>
<html>
<head>
	<title><?php echo($title)?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
</head>
<body>

<header>
	<h1>Hello <?php echo($fname ." ". $lname)?></h1>
	<a class="header-logout" href="<?php echo base_url(); ?>index.php/user/logout">Logout</a>
</header>

