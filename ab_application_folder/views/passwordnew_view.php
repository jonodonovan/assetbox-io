<div class="container">
	<div>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<h1>Password reset form</h1>

		<?php echo form_open('login/passwordreset_check'); ?>

		<?php echo form_hidden('key', $this->uri->segment(3)); ?>

		<?php $email = array('name' => 'email','id' => 'email','class' => 'full_width', 'placeholder' => 'Email Address','type' => 'email', 'required' => 'required'); ?>

		<h3>Enter your email address</h3>
		<?php echo form_input($email); ?>

		<h3><?php echo form_label('Password: ', 'password'); ?></h3>
		<?php $register_password = array('type' => 'password','name' => 'password','id' => 'password','class' => 'full_width','value' => '','placeholder' => 'Password', 'required' => 'required');
		echo form_password($register_password); ?>

		<h3><?php echo form_label('Confirm Password: ', 'cpassword'); ?></h3>
		<?php $register_cpassword = array('type' => 'cpassword','name' => 'cpassword','id' => 'cpassword','class' => 'full_width','value' => '','placeholder' => 'Confirm Password', 'required' => 'required');
		echo form_password($register_cpassword); ?>

		<br><br>
		<button type="submit" class="btn btn-success btn-lg">Submit</button>

		<?php echo form_close(); ?>

	</div>
</div>