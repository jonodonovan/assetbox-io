<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Software Manufacturers</h1>
		<p>Manage your software manufacturers.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">

		<?php echo form_open('dashboard/manage_swmanufacturers'); ?>

		<?php if ($manufacturer_dropdown == null)
		{

		} else { ?>

			<div class="col-xs-12 col-md-6">
				<h3>Current software manufacturers: </h3>
				<?php echo form_dropdown('manufacturer_dropdown', $manufacturer_dropdown, '', 'id="manufacturer_dropdown" class="form-control"'); ?><br>
				<div class="checkbox_align"><?php echo form_label(form_checkbox($del_manufacturer).'delete selected manufacturer? this will also remove associated software titles.', 'del_manufacturer'); ?></div>
			</div>

		<?php } ?>

			<div class="col-xs-12 col-md-6">
				<h3>Add a new manufacturer</h3>
				<h4>Enter the new manufacturer name: </h4>
				<p><?php echo form_input('manuname', set_value('manuname', ''), 'id="manuname"'); ?></p>
			</div>
		</div>

		<?php if ($manufacturer_dropdown == null)
		{ ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'add new software manufacturer'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } else { ?>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'update software manufacturer'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } ?>

				<div class="buff">
				To <b>ADD</b> a new	software manufacturer, enter the manufacturer name, click submit.<br>
				To <b>DELETE</b> a software manufacturer, select a manufacturer from the dropdown, check the box for delete, click submit.
				</div>
				<a href="<?php echo base_url();?>software"><i class="icon-puzzle-piece"> to software</i></a> | <a href="<?php echo base_url();?>dashboard/software_names">to software titles</a>
			</div>
		</div>
	</div>
</div>