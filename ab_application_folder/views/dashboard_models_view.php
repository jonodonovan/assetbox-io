<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Computer Model Numbers & Accessories</h1>
		<p>Computer models and accessories.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">

		<?php echo form_open('dashboard/manage_models'); ?>

		<?php if ($list_models == null)
		{

		} else { ?>

			<div class="col-xs-12 col-md-6">
				<h3>Current models & accessories: </h3>
				<?php echo form_dropdown('list_models', $list_models, '', 'id="list_models" class="form-control"'); ?><br>
				<div class="checkbox_align"><?php echo form_label(form_checkbox($del_model).'delete selected?', 'del_model'); ?></div>
			</div>

		<?php } ?>

			<div class="col-xs-12 col-md-6">
				<h3>Add new</h3>
				<h4>Select an asset type: </h4>
				<p><?php echo form_dropdown('make_dropdown', $make_dropdown, '', 'id="make_dropdown" class="form-control"'); ?> </p>
				<h4>Enter a name or number: </h4>
				<p><?php echo form_input('number', set_value('number', ''), 'id="number"'); ?></p>
			</div>
		</div>

		<?php if ($list_models == null)
		{ ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'add new'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } else { ?>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'make update'); ?>
				<?php echo form_submit($data); ?>
				<?php echo form_close(); ?>

		<?php } ?>

				<div class="buff">
				To <b>ADD</b> a new model, first select the asset type from the dropdown, enter the model number, click submit.<br>
				To <b>DELETE</b> a model, select a model from the dropdown, check the box for delete, click submit.
				</div>
				<a href="<?php echo base_url();?>computers"><i class="icon-desktop"> to computers</i></a>
			</div>
		</div>
	</div>
</div>