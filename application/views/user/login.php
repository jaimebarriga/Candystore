<!DOCTYPE html>
<html>
<head>
	<title><?php echo($title) ?></title>
</head>
<body>


<?php echo form_open('index.php/user/login'); ?>

<h5>Email Address</h5>
<?php echo form_error('password'); ?>
<input type="text" name="email" value="<?php echo set_value('email'); ?>"/>

<h5>Password</h5>
<input type="password" name="password" value="<?php echo set_value('password'); ?>"/>

<div><input type="submit" value="Submit" /></div>

</form>


</body>
</html>