<div class="settings admin-content">

<?php echo form_open('admin/clear'); ?>

<h5>Password</h5>
<?php echo form_error('password','<span class="error">', '</span>'); ?>
<input type="password" name="password" size="50">

<div><input type="submit" class="button" value="DELETE ALL CUSTOMERS AND ORDERS" /></div>

</form>

</div>