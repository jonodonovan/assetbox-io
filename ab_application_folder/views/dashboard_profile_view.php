<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline extra-padding">

		<h1>Your Profile Information</h1>
		<p>Please introduce yourself.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Your current name: </h3>
				<p><?php if($this->session->userdata('name') == "") {

					echo "name not added :-(";

				} else {

					echo $this->session->userdata('name');

				} ?>

				</p>
			</div>

			<div class="col-xs-12 col-md-6">
				<h3>Change your name?</h3>
				<p>(field is required)</p>
				<?php echo form_open('dashboard/edit_your_name'); ?>
				<?php echo form_input('name', set_value('name', $this->session->userdata('name')), 'id="name"'); ?></br></br>

				<?php $data = array('name' => 'edit_your_name', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'change name');

				echo form_submit($data);
				echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<div class="hidden-md hidden-lg">
	<div class="buff"></div>
</div>