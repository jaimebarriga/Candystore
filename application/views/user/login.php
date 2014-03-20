<!DOCTYPE html>
<html>
<head>
	<title><?php echo($title) ?></title>
</head>
<body>


<?php echo form_open('/user/login'); ?>

<h5>Username</h5>
<?php echo form_error('username'); ?>
<?php echo form_error('password'); ?>
<input type="text" name="username" value="<?php echo set_value('username'); ?>"/>

<h5>Password</h5>
<input type="password" name="password" value="<?php echo set_value('password'); ?>"/>

<div><input type="submit" value="Submit" /></div>

</form>


</body>
</html>