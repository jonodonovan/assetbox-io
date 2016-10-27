<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Mobile Models</h1>
		<p>Manage your mobile models.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">

		<?php echo form_open('dashboard/manage_mobilemodels'); ?>

		<?php if ($list_swnames == null)
		{

		} else { ?>

			<div class="col-xs-12 col-md-6">
				<h3>Current model names: </h3>
				<?php echo form_dropdown('list_swnames', $list_swnames, '', 'id="list_swnames" class="form-control"'); ?><br>
				<div class="checkbox_align"><?php echo form_label(form_checkbox($del_name).'delete selected model?', 'del_name'); ?></div>
			</div>

		<?php } ?>

			<div class="col-xs-12 col-md-6">
				<h3>Add a new mobile name</h3>
				<h4>Select <acronym></acronym> manufacturer: </h4>
				<p><?php  echo form_dropdown('manufacturer_dropdown', $manufacturer_dropdown, '', 'id="manufacturer_dropdown" class="form-control"'); ?> </p>
				<h4>Enter the new mobile name: </h4>
				<p><?php echo form_input('swname', set_value('swname', ''), 'id="swname"'); ?></p>
			</div>
		</div>

		<?php if ($list_swnames == null)
		{ ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'add new mobile model'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } else { ?>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'update mobile model'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } ?>

			<div class="buff">
			To <b>ADD</b> a new	mobile model, select the manufacturer from the dropdown, enter the mobile model, click submit.<br>
			To <b>DELETE</b> a mobile model, select a model from the dropdown, check the box for delete, click submit.
			</div>
			<a href="<?php echo base_url();?>mobile"><i class="icon-mobile-phone"> to mobile</i></a> | <a href="<?php echo base_url();?>dashboard/mobile_makes">to mobile manufacturers</a>
			</div>
		</div>
	</div>
</div>