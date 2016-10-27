<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Software Titles</h1>
		<p>Your current software titles.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">

		<?php echo form_open('dashboard/manage_swnames'); ?>

		<?php if ($list_swnames == null)
		{

		} else { ?>

			<div class="col-xs-12 col-md-6">
				<h3>Current software titles: </h3>
				<?php echo form_dropdown('list_swnames', $list_swnames, '', 'id="list_swnames" class="form-control"'); ?><br>
				<div class="checkbox_align"><?php echo form_label(form_checkbox($del_name).'delete selected software title?', 'del_name'); ?></div>
			</div>

		<?php } ?>

			<div class="col-xs-12 col-md-6">
				<h3>Add a new software title</h3>
				<h4>Select a manufacturer: </h4>
				<p><?php  echo form_dropdown('manufacturer_dropdown', $manufacturer_dropdown, '', 'id="manufacturer_dropdown" class="form-control"'); ?> </p>
				<h4>Enter the new software title: </h4>
				<p><?php echo form_input('swname', set_value('swname'), 'id="swname"'); ?></p>
			</div>
		</div>

		<?php if ($list_swnames == null)
		{ ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'add new software title'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } else { ?>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'update software title'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } ?>

				<div class="buff">
				To <b>ADD</b> a new	software name, select the manufacturer from the dropdown, enter the software name, click submit.<br>
				To <b>DELETE</b> a software name, select a name from the dropdown, check the box for delete, click submit.
				</div>
				<a href="<?php echo base_url();?>software"><i class="icon-puzzle-piece"> to software</i></a> | <a href="<?php echo base_url();?>dashboard/software_manufacturers">to software manufacturers</a>
			</div>
		</div>
	</div>
</div>