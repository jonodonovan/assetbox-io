<h2><?php echo $detail_value; ?></h2>
<?php if (!$query)
{ ?>

	<div class="alert alert-warning text-center">
	  	<h3>Sorry, no data to show.</h3>
		<h4>Not a problem, no mobile devices in the <?php echo $detail_value; ?> status.</h4>
  	</div>

<?php } else { ?>
<table class="table hover_table">
	<tr>
		<th>#</th>
		<th><input type="checkbox" class="chk_all_boxes" name="check_all"/></th>
		<th>Action</th>
        <th>Device ID</th>
        <th>Phone Number</th>
        <th>Make</th>
		<th>Model</th>
		<th>Ticket</th>
		<th>User</th>
		<th>Reason</th>
		<th>Agent</th>
		<th>Date</th>
	</tr>
<?php echo form_open('stock/update_checked'); ?>
	<?php $nr = 1;?>
	<?php foreach($query as $item):?>
		<tr>
		<td><?php echo $nr; ?></td>
		<td class="checkbox"><input type="checkbox" class="chk_box" name="item[]" value="<?php echo $item->device_id; ?>" /></td>
		<td><?php echo $item->action_type ?></td>
		<td><?php echo anchor('itemprofile/index/m/'.$item->device_id, $item->device_id) ?></td>
        <td><?php echo $item->number ?></td>
        <td><?php echo $item->make ?></td>
        <td><?php echo $item->model ?></td>
        <td><?php echo $item->ticket_num ?></td>
        <td><?php echo $item->user_id ?></td>
        <td><?php echo $item->reason ?></td>
		<td><?php
		if ($item->added_by)
		{
			$item->added_by = substr($item->added_by, 0, strpos($item->added_by, "@"));

		}
			echo $item->added_by;

		?></td>
		<td><?php echo $item->date_created ?></td>
		</tr>
	<?php $nr++; ?>
	<?php endforeach;?>
</table>
<?php echo form_hidden('formtype', 'removed_mobile'); ?>
<?php echo form_submit(array('name' => 'update', 'class' => 'btn btn-primary general_button', 'value' => 'update checked to "removed" status')); ?>
<?php echo form_close(); ?>
<?php } ?>
</br></br><a href="<?php echo base_url();?>dashboard/mobile"><i class="icon-arrow-left"> return to dashboard?</i></a></br></br></br></br></br></br>