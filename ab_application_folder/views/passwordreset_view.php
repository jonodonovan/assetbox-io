<div class="container">
	<div class="container">
		<div class="row">

			<?php $this->load->view('includes/alerts_3.php'); ?>

			<h2>Password Reset</h2>

			<?php echo form_open('login/passwordreset_submit'); ?>

			<?php $email = array('name' => 'email','id' => 'email','class' => 'full_width', 'placeholder' => 'Email Address','type' => 'email', 'required' => 'required'); ?>

			<p>Enter your email address</p>
			<?php echo form_input($email); ?>
			<p>We'll send you an email with a link to reset your account password.</p>
			<p>Didn't receive an email? Make sure to check your spam, bulk, or junk folder.</p>

			<br />
			<button type="submit" class="btn btn-success btn-lg">Reset</button>

			<?php echo form_close(); ?>

		</div>
	</div>
</div>