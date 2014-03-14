<!DOCTYPE html>
<html>
<head>
	<title><?php echo($title) ?></title>
</head>
<body>

<?php echo form_open('index.php/user/signup'); ?>

<h5>First Name</h5>
<?php echo form_error('fname'); ?>
<input type="text" name="fname" value="<?php echo set_value('fname') ?>" size="50">

<h5>Last Name</h5>
<?php echo form_error('lname'); ?>
<input type="text" name="lname" value="<?php echo set_value('lname')?>" size="50">

<h5>Username</h5>
<?php echo form_error('username'); ?>
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>Password</h5>
<?php echo form_error('password'); ?>
<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />

<h5>Password Confirm</h5>
<?php echo form_error('passconf'); ?>
<input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />

<h5>Email Address</h5>
<?php echo form_error('email'); ?>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>


</body>
</html>