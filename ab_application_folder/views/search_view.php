<?php if ($this->uri->segment(1) === "computers") { ?>

	<h2>Search results for <?php if ($search_query == "") { ?> all records <?php } echo $search_query; ?> in computer</h2>

		<table id="myTable" class="tablesorter">
			<thead>
				<th>#</th>
				<th>Asset Tag</th>
				<th>Action Type</th>
				<th>Ticket Number</th>
				<th>Tracking Number</th>
				<th>Serial Number</th>
				<th>Part Number</th>
				<th>Make</th>
				<th>Model</th>
				<th>User</th>
				<th>Reason</th>
				<th>Agent</th>
				<th>Date</th>
			</thead>
			<tbody>
			<?php $nr = 1;?>
			<?php foreach($query as $item):?>
			<tr>
				<td><?php echo $nr; ?></td>
				<td><?php echo $item->asset_tag ?></td>
				<td><?php echo $item->action_type ?></td>
				<td><?php echo $item->ticket_num; ?></td>
				<td><?php echo $item->tracking_num ?></td>
				<td><?php echo anchor('itemprofile/'.$item->serial_num, $item->serial_num) ?></td>
				<td><?php echo $item->part_num ?></td>
				<td><?php echo $item->make ?></td>
				<td><?php echo $item->model ?></td>
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
			</tbody>
			<tfoot>

			</tfoot>
		</table>
		</br>
	<div class="space"></div>

<?php } else if ($this->uri->segment(1) === "software") { ?>

	<h2>
		Search results for <?php if ($search_query == "") { ?> all records <?php } echo $search_query; ?> in software
	</h2>

	<table id="myTable" class="tablesorter">
		<thead>
			<th>#</th>
			<th>Action Type</th>
			<th>Manufacturer</th>
			<th>Name</th>
			<th>License</th>
			<th>Price</th>
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
			<td><?php echo $item->price ?></td>
			<td><?php echo $item->computer_ser ?></td>
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
		<tfoot>

		</tfoot>
	</table>

	</br>
	<div class="space"></div>


<?php } else if ($this->uri->segment(1) === "mobile") { ?>

	<h2>
		Search results for <?php if ($search_query == "") { ?> all records <?php } echo $search_query; ?> in mobile
	</h2>

	<table id="myTable" class="tablesorter">
		<thead>
			<th>#</th>
			<th>Action Type</th>
			<th>Make</th>
			<th>Model</th>
			<th>Number</th>
			<th>Device ID</th>
			<th>Price</th>
			<th>Location</th>
			<th>User</th>
			<th>Agent</th>
			<th>Date</th>
		</thead>
		<tbody>
		<?php $nr = 1;?>
		<?php foreach($query as $item):?>
		<tr>
			<td><?php echo $nr; ?></td>
			<td><?php echo $item->action_type ?></td>
			<td><?php echo $item->make ?></td>
			<td><?php echo $item->model ?></td>
			<td><?php echo $item->number ?></td>
			<td><?php echo $item->device_id ?></td>
			<td><?php echo $item->price ?></td>
			<td><?php echo $item->location ?></td>
			<td><?php echo $item->user_id ?></td>
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

	</br>
	<div class="space"></div>

<?php } ?>