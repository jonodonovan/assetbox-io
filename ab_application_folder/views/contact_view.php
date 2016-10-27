<div class="container">

	<?php $this->load->view('includes/alerts_3.php'); ?>

	<?php echo form_open('contact/submit'); ?>
	<?php
		$email = array('name' => 'email','id' => 'email','class' => 'full_width', 'placeholder' => 'example@assetbox.io','type' => 'email', 'required' => 'required');
		$message = array('name' => 'message','id' => 'yourmessage', 'class' => 'full_width', 'rows' => '5','placeholder'	=> 'Hello...', 'required' => 'required');
	?>

	<h2>
		<?php if (!$this->session->userdata('name') == "" && !$this->session->userdata('email') == "")
		{
			echo "Hello ".$this->session->userdata('email').", how can I help you?";

		} else  {

			echo "Hello, how can I help you?";

		} ?>
	</h2>

	<p>Please enter an email address to contact you back.
	<?php echo form_input($email); ?></p>

	<p>Your message (if your email above is different than the one used for your account, please include your account email address).
	<?php echo form_textarea($message); ?></p>

	<button type="submit" class="btn btn-lg btn-success">Continue</button>

	<?php echo form_close(); ?>

</div>

<div class="hidden-md hidden-lg">
	<div class="buff"></div>
</div>