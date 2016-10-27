<?php if ($is_deleted === "yes")
{ ?>

	<div>
		<div class="item-deleted">Asset has been deleted.</div>

<?php } else { ?>

	<div>

<?php } ?>



	<?php if ($this->uri->segment(3) == "c")
	{ ?>

	<?php

	/*
	|
	|
	|	Computer view setup
	|
	|
	*/

	?>
	<?php $this->load->view('includes/computer_delete_modal.php'); ?>

		<div class="row">
			<div class="col-xs-12 col-md-7">
				<h2>Profile for Serial Number <?php echo $item_number; ?></h2>
				<p><?php echo $model; ?> <?php echo $make; ?> <?php echo $part_num; ?></p>
			</div>
		</div>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<?php echo form_open('itemprofile/index/c/'.$item_number.'/edit'); ?>
		<?php echo form_hidden('serial_num', $item_number); ?>

	    <h3><span class="label label-default">Hardware Information</span></h3>
		<div class="row">
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Part Number: The asset's part number."> <?php echo form_label('Part Number: ', 'part_num'); ?></a><br>
	        <?php echo form_input('part_num', set_value('part_num', $part_num, 'id="part_num"')); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Asset Tag: The computers asset tag. If not used, leave blank."> <?php echo form_label('Asset Tag: ', 'atag'); ?></a><br>
			<?php echo form_input('atag', set_value('atag', $atag, 'id="atag"')); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Hostname: This is the computer's hostname. If not used, leave blank."><?php echo form_label('Hostname: ', 'hostname'); ?></a><br>
			<?php echo form_input('hostname', set_value('hostname', $hostname, 'id="hostname"'), 'id="hostname"'); ?></div>
			<div class="col-xs-12 col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="CPU: Processor info"> <?php echo form_label('CPU: ', 'cpu'); ?></a><br>
			<?php echo form_input('cpu', set_value('cpu', $cpu, 'id="cpu"')); ?></div>
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="RAM: System memory"> <?php echo form_label('RAM: ', 'ram'); ?></a><br>
	        <?php echo form_input('ram', set_value('ram', $ram, 'id="ram"')); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Hard disk drive size"> <?php echo form_label('HDD: ', 'hdd'); ?></a><br>
			<?php echo form_input('hdd', set_value('hdd', $hdd, 'id="hdd"')); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Operating system"><?php echo form_label('OS: ', 'os'); ?></a><br>
			<?php echo form_input('os', set_value('os', $os, 'id="os"'), 'id="os"'); ?></div>
		</div>

	    <h3><span class="label label-default">User Information</span></h3>
		<div class="row">
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="User: User for this action. If not used, leave blank."> <?php echo form_label('User: ', 'user_id'); ?></a><br>
			<?php echo form_input('user_id', set_value('user_id', $user_id, 'id="user_id"')); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Location: The asset's current location."> <?php echo form_label('Location: ', 'location'); ?></a><br>
			<?php echo form_input('location', set_value('location', $location, 'id="location"')); ?></div>
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Company Name"> <?php echo form_label('Company: ', 'company'); ?></a><br>
			<?php echo form_input('company', set_value('company', $company, 'id="company"')); ?></div>
	    </div>

		<h3><span class="label label-default">Purchase Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Purchase Date:"> <?php echo form_label('Purchase Date: ', 'purchased_date'); ?></a>
			<?php echo form_input('purchased_date', set_value('purchased_date', $purchased_date, 'id="purchased_date"'), 'id="purchased_date"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Purchased From:"> <?php echo form_label('Purchased From: ', 'purchased_from'); ?></a>
			<?php echo form_input('purchased_from', set_value('purchased_from', $purchased_from, 'id="purchased_from"'), 'id="purchased_from"'); ?></div>
	       	<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Price:"> <?php echo form_label('Price: ', 'price'); ?></a>
	        <?php echo form_input('price', set_value('price', $price, 'id="price"'), 'id="price"'); ?></div>
	    </div>

	    <h3><span class="label label-default">Support Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contact Name:"> <?php echo form_label('Support Name: ', 'support_name'); ?></a>
			<?php echo form_input('support_name', set_value('support_name', $support_name, 'id="support_name"'), 'id="support_name"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contact Number:"> <?php echo form_label('Support Contact Number: ', 'support_number'); ?></a>
			<?php echo form_input('support_number', set_value('support_number', $support_number, 'id="support_number"'), 'id="support_number"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contract Start Date:"> <?php echo form_label('Support Contract Start Date: ', 'scsd'); ?></a>
	        <?php echo form_input('scsd', set_value('scsd', $scsd, 'id="scsd"'), 'id="scsd"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contract End Date:"> <?php echo form_label('Support Contract End Date: ', 'sced'); ?></a>
	        <?php echo form_input('sced', set_value('sced', $sced, 'id="sced"'), 'id="sced"'); ?></div>
	    </div>

	    <h3><span class="label label-default">Temporary Use/Loan</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Asset Return Date:"> <?php echo form_label('Return Date: ', 'temp_date'); ?></a>
	        <?php echo form_input('temp_date', set_value('temp_date', $temp_date, 'id="temp_date"'), 'id="temp_date"'); ?></div>
			<div class="col-xs-12 col-md-6">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Special Notes:"> <?php echo form_label('Notes: ', 'temp_notes'); ?></a>
			<?php echo form_input('temp_notes', set_value('temp_notes', $temp_notes, 'id="temp_notes"'), 'id="temp_notes"'); ?></div>
	    </div>

	    <hr />
	    <div class="row">
			<div class="col-xs-12 col-md-3 required">
			<a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field"> <label for="action_type">Action: </label></a><br>
			<?php echo form_dropdown('action_type', $action_type, $action_type_set, 'id="action_type" class="form-control input-sm"'); ?></div>
			<div class="required col-xs-12 col-md-3">
			<a class="tip" data-toggle="tooltip" data-placement="right" title="Reason: The reason for the edit. Required Field."> <?php echo form_label('Reason for Edit: ', 'reason'); ?></a><br>
	        <?php echo form_input('reason', set_value('reason', '', 'id="reason"')); ?></div>
	        <div class="col-xs-12 col-md-3 button_fix"><?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'update')); ?></div>
		</div>

		<?php form_close(); ?>

		<div class="row">
			<div class="hidden-xs hidden-sm col-xs-12">
				<h3>History</h3>
				<div class="table hover_table">
					<?php $this->table->set_heading('Action', 'Ticket Number', 'User', 'Reason', 'Agent', 'Date'); ?>
					<?php echo $this->table->generate($records); ?>
					<?php $this->table->clear(); ?>
					<br>
					<?php echo $this->pagination->create_links(); ?>
				</div>

				<?php if ($sw_records) { ?>

				<h3>Installed Software</h3>
				<div class="table hover_table">
					<?php $this->table->set_heading('Manufacturer', 'Name','License', 'Agent', 'Date'); ?>
					<?php echo $this->table->generate($sw_records); ?>
					<?php $this->table->clear(); ?>
				</div>

				<?php } ?>

			</div>
		</div>
		<br>
		<div class="row">
			<div class="hidden-xs hidden-sm col-md-offset-7 col-md-5 text-right">

			<?php if ($is_deleted === "yes")
			{ ?>

				<a class="btn btn-danger" href="#" data-toggle="modal">asset already deleted!</a>

			<?php } else { ?>

				<a class="btn btn-danger" href="#confirm-delete" data-toggle="modal">delete <?php echo $item_number; ?>?</a>

			<?php } ?>

			</div>
		</div>

		<div class="buff"></div>

	<?php } else if ($this->uri->segment(3) == "m") { ?>

	<?php

	/*
	|
	|
	|	Mobile view setup
	|
	|
	*/


	?>
	<?php $this->load->view('includes/mobile_delete_modal.php'); ?>
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<h2>Profile for Device ID <?php echo $item_number; ?></h2>
			<p><?php echo $make; ?> <?php echo $model; ?></p>
		</div>
	</div>

	<?php $this->load->view('includes/alerts_3.php'); ?>

	<?php echo form_open('itemprofile/index/m/'.$item_number.'/edit'); ?>
	<?php echo form_hidden('device_id', $item_number); ?>

		<h3><span class="label label-default">Account Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Contract End Date: The devices carrier end date. If not used, leave blank."> <?php echo form_label('Contract End Date: ', 'ced'); ?></a>
			<?php echo form_input('ced', set_value('ced', $ced, 'id="ced"'), 'id="ced"'); ?></div>
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Contract Renewal Date: The devices carrier renewal date. If not used, leave blank."> <?php echo form_label('Contract Renewal Date: ', 'crd'); ?></a>
	        <?php echo form_input('crd', set_value('crd', $crd, 'id="crd"'), 'id="crd"'); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Phone Number: Phone number assigned to the device. If not used, leave blank."> <?php echo form_label('Number: ', 'number'); ?></a>
	        <?php echo form_input('number', set_value('number', $number, 'id="number"'), 'id="number"'); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Price: If not used, leave blank."> <?php echo form_label('Price: ', 'price'); ?></a>
	        <?php echo form_input('price', set_value('price', $price, 'id="price"'), 'id="price"'); ?></div>
	    </div>

	    <h3><span class="label label-default">User Information</span></h3>
	    <div class="row">
	        <div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="User: User for this action. If not used, leave blank."> <?php echo form_label('User: ', 'user_id'); ?></a>
			<?php echo form_input('user_id', set_value('user_id', $user_id, 'id="user_id"'), 'id="user_id"'); ?></div>
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Location: The asset's current location."> <?php echo form_label('Location: ', 'location'); ?></a><br>
			<?php echo form_input('location', set_value('location', $location, 'id="location"')); ?></div>
		</div>
	    <h3><span class="label label-default">Temporary Use/Loan</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Asset Return Date:"> <?php echo form_label('Return Date: ', 'temp_date'); ?></a>
	        <?php echo form_input('temp_date', set_value('temp_date', $temp_date, 'id="temp_date"'), 'id="temp_date"'); ?></div>
			<div class="col-xs-12 col-md-6">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Special Notes:"> <?php echo form_label('Notes: ', 'temp_notes'); ?></a>
			<?php echo form_input('temp_notes', set_value('temp_notes', $temp_notes, 'id="temp_notes"'), 'id="temp_notes"'); ?></div>
	    </div>
		<hr />
		<div class="row">
			<div class="required col-xs-12 col-md-3">
			<a class="tip" data-toggle="tooltip" data-placement="right" title="Reason: The reason for the edit. Required Field."> <?php echo form_label('Reason for Edit: ', 'reason'); ?></a>
	        <?php echo form_input('reason', set_value('reason', '', 'id="reason"')); ?></div>
	        <div class="col-xs-12 col-md-3 button_fix"><?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Update')); ?></div>
		</div>

	<?php form_close(); ?>

	</br>
	<h2>History</h2>
	<div class="table hover_table">
		<?php $this->table->set_heading('Action','Number','Ticket','User','Reason','Agent', 'Date'); ?>
		<?php echo $this->table->generate($mobile_records); ?>
		<br>
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<br>
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-offset-7 col-md-5 text-right">

		<?php if ($is_deleted === "yes")
		{ ?>

			<a class="btn btn-danger" href="#" data-toggle="modal">asset already deleted!</a>

		<?php } else { ?>

			<a class="btn btn-danger" href="#confirm-delete" data-toggle="modal">delete <?php echo $item_number; ?>?</a>

		<?php } ?>

		</div>
	</div>

	<div class="buff"></div>

	<?php } else { ?>

	<?php

	/*
	|
	|
	|	Software view setup
	|
	|
	*/


	?>
	<?php $this->load->view('includes/software_delete_modal.php'); ?>

	<div class="row">
		<div class="col-xs-12 col-md-12">
			<h2>Profile for Software License <?php echo $license; ?></h2>
			<p><?php echo $manufacturer; ?> <?php echo $name; ?>

			<?php if ($computer_ser) { ?>

				installed on <?php echo anchor('itemprofile/index/c/'.$computer_ser,$computer_ser); ?>

			<?php } ?></p>

		</div>
	</div>

	<?php $this->load->view('includes/alerts_3.php'); ?>

	<?php echo form_open('itemprofile/index/s/'.$item_number.'/edit'); ?>
	<?php echo form_hidden('device_id', $item_number); ?>

		<h3><span class="label label-default">Purchase Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
			<a class="tip black" data-toggle="tooltip" data-placement="right" title="Purchase Date:"> <?php echo form_label('Purchase Date: ', 'purchased_date'); ?></a>
			<?php echo form_input('purchased_date', set_value('purchased_date', $purchased_date, 'id="purchased_date"'), 'id="purchased_date"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Purchased From:"> <?php echo form_label('Purchased From: ', 'purchased_from'); ?></a>
			<?php echo form_input('purchased_from', set_value('purchased_from', $purchased_from, 'id="purchased_from"'), 'id="purchased_from"'); ?></div>
	       	<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Price:"> <?php echo form_label('Price: ', 'price'); ?></a>
	        <?php echo form_input('price', set_value('price', $price, 'id="price"'), 'id="price"'); ?></div>
	    </div>

	    <h3><span class="label label-default">License Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="License Start Date:"> <?php echo form_label('License Start Date: ', 'csd'); ?></a>
	        <?php echo form_input('csd', set_value('csd', $csd, 'id="csd"'), 'id="csd"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="License End Date:"> <?php echo form_label('License End Date: ', 'ced'); ?></a>
	        <?php echo form_input('ced', set_value('ced', $ced, 'id="ced"'), 'id="ced"'); ?></div>
	    </div>

	    <h3><span class="label label-default">Support Information</span></h3>
		<div class="row">
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contact Name:"> <?php echo form_label('Support Name: ', 'support_name'); ?></a>
			<?php echo form_input('support_name', set_value('support_name', $support_name, 'id="support_name"'), 'id="support_name"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contact Number:"> <?php echo form_label('Support Contact Number: ', 'support_number'); ?></a>
			<?php echo form_input('support_number', set_value('support_number', $support_number, 'id="support_number"'), 'id="support_number"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contract Start Date:"> <?php echo form_label('Support Contract Start Date: ', 'scsd'); ?></a>
	        <?php echo form_input('scsd', set_value('scsd', $scsd, 'id="scsd"'), 'id="scsd"'); ?></div>
			<div class="col-xs-12 col-md-3">
	        <a class="tip black" data-toggle="tooltip" data-placement="right" title="Support Contract End Date:"> <?php echo form_label('Support Contract End Date: ', 'sced'); ?></a>
	        <?php echo form_input('sced', set_value('sced', $sced, 'id="sced"'), 'id="sced"'); ?></div>
	    </div>
	    <hr />
		<div class="row">
			<div class="required col-xs-12 col-md-3">
			<a class="tip" data-toggle="tooltip" data-placement="right" title="Reason: The reason for the edit. Required Field."> <?php echo form_label('Reason for Edit: ', 'reason'); ?></a>
	        <?php echo form_input('reason', set_value('reason', '', 'id="reason"')); ?></div>
	        <div class="col-xs-12 col-md-3 button_fix"><?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Update')); ?></div>
		</div>

	<?php form_close(); ?>

	</br>
	<div class="row">
		<div class="hidden-xs hidden-sm col-xs-12">
			<h3>History</h3>
			<div class="table hover_table">
				<?php $this->table->set_heading('Action','License','Reason','Agent', 'Date'); ?>
				<?php echo $this->table->generate($software_records); ?>
				<br>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-offset-7 col-md-5 text-right">

		<?php if ($is_deleted === "yes")
		{ ?>

			<a class="btn btn-danger" href="#" data-toggle="modal">license already deleted!</a>

		<?php } else { ?>

			<a class="btn btn-danger" href="#confirm-delete-modal" data-toggle="modal">delete license <?php echo $license; ?>?</a>

		<?php } ?>

		</div>
	</div>
	<div class="buff"></div>

	<?php } ?>

</div>