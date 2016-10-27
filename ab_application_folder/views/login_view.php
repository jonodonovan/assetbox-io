<div class="container">
<?php $this->load->view('includes/alerts_3.php'); ?>

	<h2>Please try again</h2>

	<?php echo form_open('login/check', array('id' => 'login-form')); ?>

	<p><?php echo form_label('Email Address: ', 'email'); ?>
	<?php $login_email =
	array('type' => 'email','name' => 'email','id' => 'loginemail', 'class' => 'full_width','value' => '','placeholder' => 'example@assetbox.io', 'autofocus'   => 'autofocus', 'required' => 'required');
	echo form_input($login_email); ?></p>

	<p><?php echo form_label('Password: ', 'password'); ?>
	<?php $login_password = array('type' => 'password','name' => 'password','id' => 'loginpassword','class' => 'full_width','value' => '','placeholder' => 'Password','required' => 'required');
	echo form_password($login_password); ?></p>

	<br>
	<p>By clicking "Login", you agree to our <b><a href="<?php echo base_url(); ?>legal/privacy" target="_blank">privacy policy</a></b> & <b><a href="<?php echo base_url(); ?>legal/tos" target="_blank">terms of service</a></b> and understand we may send you email regarding AssetBox.io.</p>
	<button type="submit" class="btn btn-primary btn-lg">Login</button>

	<?php echo form_close(); ?>
	<br>
	<a href="<?php echo base_url();?>login/reset">Forgot Password?</a>

</div>

<div class="hidden-md hidden-lg">
	<div class="buff"></div>
</div>