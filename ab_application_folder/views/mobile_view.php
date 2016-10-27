<?php if (!$mobile_history) { ?>

	<h1>Mobile</h1>
	<p>Add mobile <a href="<?php echo base_url();?>dashboard/mobile_makes">manufacturers</a> and the <a href="<?php echo base_url();?>dashboard/mobile_models">model</a> from the <a href="<?php echo base_url();?>settings">Settings</a> menu.</p>

<?php } ?>

<?php $this->load->view('includes/alerts_3.php'); ?>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#mobile">
            <div class="panel-heading">
                <h4 class="panel-title">

                    <i class="icon-mobile-phone panel-fill"> Mobile Actions</i>

                </h4>
            </div>
        </a>

    <?php if ($block === '1' || !$block)
    { ?>

		<div id="mobile" class="panel-collapse collapse in">

    <?php } else { ?>

    	<div id="mobile" class="panel-collapse collapse">

	<?php } ?>

            <div class="panel-body">

                <?php echo form_open('mobile/mobilecheck'); ?>

                <div class="row">

                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field"> <label>Action: </label></a>
                    <?php echo form_dropdown('action_type', $action_type, '', 'id="action_type" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Deivce ID: Depending on the carrier, this could be the IMEI or ESN number, basically the device's ID or serial. Required Field"> <?php echo form_label('Device ID (IMEI/ESN):', 'device_id'); ?></a>
                    <?php echo form_input('device_id', set_value('device_id', '', 'id="device_id"'), 'id="device_id"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Ticket Number: Ticket number for this action. If not used, leave blank."> <?php echo form_label('Ticket Number: ', 'ticket_num'); ?></a>
                    <?php echo form_input('ticket_num', set_value('ticket_num', '', 'id="ticket_num"'), 'id="ticket_num"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Tracking Number: Tracking or shipping number if the item is being shipped. If not used, leave blank."> <?php echo form_label('Tracking Number: ', 'tracking_num'); ?></a>
                    <?php echo form_input('tracking_num', set_value('tracking_num', '', 'id="tracking_num"'), 'id="tracking_num"'); ?></div>

        		</div>

                <div class="row">

        			<div class="col-xs-12 col-md-3 space">
        			<?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>

                </div>

        		<?php echo form_close(); ?>

            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#add_mobile">
            <div class="panel-heading">
                <h4 class="panel-title">

                    <i class="icon-plus panel-fill"> Add a New Mobile Device</i>

                </h4>
            </div>
        </a>

    <?php if ($block === '2')
    { ?>

		<div id="add_mobile" class="panel-collapse collapse in">

    <?php } else { ?>

    	<div id="add_mobile" class="panel-collapse collapse">

	<?php } ?>

            <div class="panel-body">

          		<?php echo form_open('mobile/deviceadd'); ?>

    			<div class="row">

    				<div class="col-xs-12 col-md-3 required">
    				<a class="tip" data-toggle="tooltip" data-placement="right" title="Make: The manufacturer of the device. Required Field"> <label for="mobile_make_dropdown">Make: </label></a>
    				<?php echo form_dropdown('mobile_make_dropdown', $mobile_make_dropdown, '', 'id="mobile_make_dropdown" class="form-control input-sm"'); ?></div>

    				<div class="col-xs-12 col-md-3 required">
    				<a class="tip" data-toggle="tooltip" data-placement="right" title="Model: The device model number or name. Required Field"> <label for="mobile_model_dropdown">Model: </label></a>
    				<?php echo form_dropdown('mobile_model_dropdown', $mobile_model_dropdown, '', 'id="mobile_model_dropdown" class="form-control input-sm"'); ?></div>

    				<div class="col-xs-12 col-md-3 required">
    				<a class="tip" data-toggle="tooltip" data-placement="right" title="Deivce ID: Depending on the carrier, this could be the IMEI or ESN number, basically the device's ID or serial. Required Field"> <?php echo form_label('Device ID (IMEI/ESN):', 'device_id2'); ?></a>
    				<?php echo form_input('device_id', set_value('device_id', '', 'id="device_id"'), 'id="device_id2"'); ?></div>

                </div>

                <div class="row">

    				<div class="col-xs-12 col-md-3 space">
    				<?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>

    			</div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="additional-links"><b>Additional Links:</b> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#add_mobile">Add New Mobile Device</a> | <a href="<?php echo base_url();?>dashboard/mobile_makes">Add New Mobile Manufacturer</a> | <a href="<?php echo base_url();?>dashboard/mobile_models">Add New Mobile Model</a></div>
    </div>
</div>

<?php if (!$mobile_history) {

} else { ?>

    <div class="hidden-xs">
        <div class="spacer_bar"></div>
            <div class="table hover_table">

            <?php echo $this->table->generate($mobile_history); ?>

            </br>

            <?php echo $this->pagination->create_links(); ?>

        </div>
    </div>

<?php } ?>

<div class="container">
    <div class="row">
        <div class="hidden-xs hidden-sm">
            <div class="input-group pull-right">
                <?php echo form_open('mobile/search'); ?>

                    <div class="col-xs-2">
                        <?php $search = array('name'=>'search','id'=>'search_id','value'=>"", 'class' => 'form-control'); ?>
                    </div>

                    <div class="col-xs-10">
                        <?php echo form_input($search); ?>
                        <?php echo form_submit(array('name' => 'submit', 'class' => 'input-group-btn search', 'value' => 'Search')); ?>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class="hidden-sm"><br><br></div>