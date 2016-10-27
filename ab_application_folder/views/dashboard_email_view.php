<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Email Settings</h1>
		<p>These settings do not change your username.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Your main email address: </h3>
				<p><?php echo $this->session->userdata('email'); ?></p>
			</div>

			<div class="col-xs-12 col-md-6">
				<h3>Use another address for alerts?</h3>
				<p>(leave blank to use your main email address)</p>

				<?php echo form_open('dashboard/edit_your_email'); ?>

					<?php echo form_input('alt_email', set_value('alt_email', $this->session->userdata('alt_email')), 'id="alt_email"'); ?></br></br>
					<?php $data = array(
									'name' => 'edit_your_email',
									'class' => 'btn btn-primary',
									'type' => 'submit',
									'value' => 'submit'
								);

				echo form_submit($data);
				echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<div class="hidden-md hidden-lg">
	<div class="buff"></div>
</div>