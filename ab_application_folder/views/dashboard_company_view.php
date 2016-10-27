<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Company Settings</h1>
		<p>Edit company specific settings.</p>
		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3>Your current company name:</h3>
				<p><?php if($this->session->userdata('company_name') == "") {

					echo "company name not added :-(";

				} else {

					echo $this->session->userdata('company_name');

				} ?>

				</p>
			</div>

			<div class="col-xs-12 col-md-6">

				<?php echo form_open('dashboard/edit_company_name'); ?>
				<h3>Change company name?</h3>
				<p>(leave blank to clear the name)</p>
				<?php echo form_input('cname', set_value('cname', $this->session->userdata('company_name')), 'id="cname"'); ?><br><br>
				<?php $data = array(
								'name' => 'edit_compnay_name',
								'class' => 'btn btn-primary',
								'type' => 'submit',
								'value' => 'change company name'
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