<?php if (!$software_history) { ?>

	<h1>Software</h1>
	<p>Add software <a href="<?php echo base_url();?>dashboard/software_manufacturers">manufacturers</a> and the <a href="<?php echo base_url();?>dashboard/software_names">software names</a> from the <a href="<?php echo base_url();?>settings">Settings</a> menu.</p>

<?php } ?>

<?php $this->load->view('includes/alerts_3.php'); ?>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="icon-puzzle-piece panel-fill"> Software Actions</i>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">

                <?php echo form_open('software/itemadd'); ?>

            	<div class="row">
                    <div class="col-xs-12 col-md-3 required">
            		<a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field"> <label>Action: </label></a></br>
            		<?php echo form_dropdown('action_type', $action_type, '', 'id="action_type" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required"><div class="noshow">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Computer Serial: Select the action you want to perform for this asset. Required Field"> <label>Computer Serial: </label></a>
            		<?php echo form_dropdown('computer', $computer_dropdown, '', 'id="computer" class="form-control input-sm dd-fix"'); ?></div></div>
            	</div>

            	<div class="row">
            		<div class="col-xs-12 col-md-3 required">
            		<a class="tip" data-toggle="tooltip" data-placement="right" title="Manufacturer: Maker of the software. Required Field"> <label>Manufacturer: </label></a></br>
            		<?php echo form_dropdown('manufacturer_dropdown', $manufacturer_dropdown, '', 'id="manufacturer_dropdown" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required">
            		<?php $sw_names['Unknown'] = 'Please Select'; ?>
            		<a class="tip" data-toggle="tooltip" data-placement="right" title="Software Name: Name of the software. Required Field"> <label for="sw_names">Software Name: </label></a></br>
            		<?php echo form_dropdown('sw_name', $sw_names, '', 'id="sw_names" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3">
            		<a class="tip black" data-toggle="tooltip" data-placement="right" title="License Number: License number of the software."> <?php echo form_label('License Number: ', 'license_num'); ?></a>
            		<?php echo form_input('license_num', set_value('license_num', '', 'id="license_num"'), 'id="license_num"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Ticket Number:"> <?php echo form_label('Ticket Number: ', 'ticket_num'); ?></a>
                    <?php echo form_input('ticket_num', set_value('ticket_num', '', 'id="ticket_num"'), 'id="ticket_num"'); ?></div>
                </div>
            	<div class="row">
            		<div class="col-xs-12 col-md-3 space">
            		<?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>
            	</div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
        <div class="additional-links"><b>Additional Links:</b> <a href="<?php echo base_url();?>dashboard/software_manufacturers">Add New Manufacturer</a> | <a href="<?php echo base_url();?>dashboard/software_names">Add New Software Title</a></div>
    </div>
</div>

<?php if (!$software_history) {

} else { ?>

<div class="hidden-xs">
    <div class="spacer_bar"></div>
    <div class="table hover_table">

    	<?php echo $this->table->generate($software_history); ?>

    	</br>

    	<?php echo $this->pagination->create_links(); ?>

    </div>
</div>

<?php } ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 hidden-xs hidden-sm">
			<div class="input-group pull-right">

				<?php echo form_open('software/search'); ?>

					<div class="col-xs-1">
						<?php $search = array('name'=>'search','id'=>'search_id','value'=>"", 'class' => 'form-control'); ?>
					</div>

					<div class="col-xs-11">
						<?php echo form_input($search); ?>
						<?php echo form_submit(array('name' => 'submit', 'class' => 'input-group-btn', 'value' => 'Search')); ?>
					</div>

				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
<div class="hidden-sm"><br><br></div>