<h2><?php echo $detail_value; ?></h2>
<?php if (!$query)
{ ?>

	<div class="alert alert-warning text-center">
	  	<h3>Sorry, no data to show.</h3>
		<h4>Not a problem, no software in the <?php echo $detail_value; ?> status.</h4>
  	</div>

<?php } else { ?>
<table id="myTable" class="tablesorter">
	<thead>
		<th>#</th>
		<th>Action</th>
        <th>Manufacturer</th>
        <th>Software Name</th>
		<th>License</th>
		<th>Computer Serial</th>
		<th>Agent</th>
		<th>Date</th>
	</thead>
	<tbody>
	<?php $nr = 1;?>
	<?php foreach($query as $item):?>
		<tr>
			<td><?php echo $nr; ?></td>
			<td><?php echo $item->action_type ?></td>
	        <td><?php echo $item->manufacturer ?></td>
	        <td><?php echo $item->name ?></td>
	        <td><?php echo $item->license ?></td>
			<td><?php

			if ($item->computer_ser == "")
			{
				echo "";

			} else {

				echo anchor('itemprofile/index/c/'.$item->computer_ser, $item->computer_ser);
			}

			?></td>
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
	</tbody>
</table>
<?php } ?>
</br><a href="<?php echo base_url();?>dashboard/software"><i class="icon-arrow-left"> return to dashboard?</i></a></br></br></br></br></br></br>