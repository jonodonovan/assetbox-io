<?php if (!$records) { ?>

	<h1>Computers</h1>
	<p>Add computer <a href="<?php echo base_url();?>dashboard/computer_models">models</a> from the <a href="<?php echo base_url();?>settings">settings</a> menu.</p>

<?php } ?>

<?php $this->load->view('includes/alerts_3.php'); ?>

<div class="panel-group" id="accordion">

<?php if ($this->session->userdata('barcode') == 0) { ?>

<div class="panel panel-default">
    <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#computers_serial">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="icon-barcode panel-fill"> Computer Actions</i>
            </h4>
        </div>
    </a>
    <?php if ($block === '1' || !$block)
    { ?>

        <div id="computers_serial" class="panel-collapse collapse in">

    <?php } else { ?>

        <div id="computers_serial" class="panel-collapse collapse">

    <?php } ?>

      <div class="panel-body">

            <?php echo form_open('computers/serialnumber_action'); ?>

            <div class="row">

                <div class="col-xs-12 col-md-3 required">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field"> <label for="action_type">Action: </label></a><br>
                <?php echo form_dropdown('action_type', $action_type, '', 'id="action_type" class="form-control input-sm"'); ?></div>

                <div class="col-xs-12 col-md-3 required_hide">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Serial Number: The asset's serial number. Required Field"> <?php echo form_label('Serial Number: ', 'serial_num'); ?></a>
                <?php echo form_input('serial_num', set_value('serial_num', '', 'id="serial_num"'), 'id="serial_num"'); ?></div>

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

<?php } else { ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <i class="icon-tag panel-fill"> Computer Actions by Asset Tag</i>
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">

            <?php echo form_open('computers/actionedit_byasset'); ?>

            <div class="row">
                <div class="col-xs-12 col-md-3 required">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field."> <label>Action: </label></a><br>
                <?php echo form_dropdown('action_type', $action_type, '', 'id="action_type" class="form-control input-sm"'); ?></div>
                <div class="col-xs-12 col-md-3 required">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Asset Tag: The computers asset tag. Required Field."> <?php echo form_label('Asset Tag: ', 'atag'); ?></a>
                <?php echo form_input('atag', set_value('atag', $atag, 'id="atag"')); ?></div>
                <div class="col-xs-12 col-md-3 col-md-offset-3 space hidden-xs hidden-sm">
                <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-3">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Ticket Number: Ticket number for this action. If not used, leave blank."> <?php echo form_label('Ticket Number: ', 'ticket_num'); ?></a>
                <?php echo form_input('ticket_num', set_value('ticket_num', '', 'id="ticket_num"'), 'id="ticket_num"'); ?></div>
                <div class="col-xs-12 col-md-3">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="User: User for this action. If not used, leave blank."> <?php echo form_label('User: ', 'user_id'); ?></a></br>
                <?php echo form_input('user_id', set_value('user_id', '', 'id="user_id"'), 'id="user_id"'); ?></div>
                <div class="col-xs-12 col-md-3">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Reason: Reason for this action. If not used, leave blank."> <?php echo form_label('Reason: ', 'reason'); ?></a></br>
                <?php echo form_input('reason', set_value('reason', '', 'id="reason"'), 'id="reason"'); ?></div>
                <div class="col-xs-12 col-md-3">
                <a class="tip" data-toggle="tooltip" data-placement="right" title="Tracking Number: Tracking or shipping number if the item is being shipped. If not used, leave blank."> <?php echo form_label('Tracking Number: ', 'tracking_num'); ?></a>
                <?php echo form_input('tracking_num', set_value('tracking_num', '', 'id="tracking_num"'), 'id="tracking_num"'); ?></div>
                <div class="col-xs-12 col-md-3 space hidden-md hidden-lg">
                <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<?php } ?>

    <div class="panel panel-default">
        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#accessories">
            <div class="panel-heading">
                <h4 class="panel-title">

                    <i class="icon-keyboard panel-fill"> Computer Accessories</i>

                </h4>
            </div>
        </a>

        <?php if ($block === '3')
        { ?>

        <div id="accessories" class="panel-collapse collapse in">

        <?php } else { ?>

        <div id="accessories" class="panel-collapse collapse">

        <?php } ?>

            <div class="panel-body">

            <?php

            if ($accessory_dropdown == '')
            { ?>

                <div class="col-xs-12 col-md-3"><br>
                <a href="<?php echo base_url();?>dashboard/computer_models">Add Accessories to use.</a></div>

            <?php } else { ?>

                <?php echo form_open('computers/accessory_add'); ?>

                <div class="row">

                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Action: Select the action you want to perform for this asset. Required Field."> <label for="action_type2">Action: </label></a><br>
                    <?php echo form_dropdown('action_type', $action_type, '', 'id="action_type2" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Accessory: Select the accessory name. Required Field."> <label for="accessory_dropdown">Accessory: </label></a><br>
                    <?php echo form_dropdown('accessory_dropdown', $accessory_dropdown, '', 'id="accessory_dropdown" class="form-control input-sm"'); ?></div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Ticket Number: Ticket number for this action. If not used, leave blank."> <?php echo form_label('Ticket Number: ', 'ticket_num2'); ?></a>
                    <?php echo form_input('ticket_num', set_value('ticket_num', '', 'id="ticket_num"'), 'id="ticket_num2"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="User: User for this action. If not used, leave blank."> <?php echo form_label('User: ', 'user_id2'); ?></a></br>
                    <?php echo form_input('user_id', set_value('user_id', '', 'id="user_id"'), 'id="user_id2"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Reason: Reason for this action. If not used, leave blank."> <?php echo form_label('Reason: ', 'reason2'); ?></a></br>
                    <?php echo form_input('reason', set_value('reason', '', 'id="reason"'), 'id="reason2"'); ?></div>

                    <div class="col-xs-12 col-md-3">
                    <a class="tip black" data-toggle="tooltip" data-placement="right" title="Tracking Number: Tracking or shipping number if the item is being shipped. If not used, leave blank."> <?php echo form_label('Tracking Number: ', 'tracking_num2'); ?></a>
                    <?php echo form_input('tracking_num', set_value('tracking_num', '', 'id="tracking_num"'), 'id="tracking_num2"'); ?></div>

                    <div class="col-xs-12 col-md-3 space">
                    <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'submit')); ?></div>

                </div>

                <?php echo form_close(); ?>

            <?php } ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#add_computer">
            <div class="panel-heading">
                <h4 class="panel-title">

                    <i class="icon-plus panel-fill"> Add a New Computer</i>

                </h4>
            </div>
        </a>

            <?php if ($block === '4')
            { ?>

                <div id="add_computer" class="panel-collapse collapse in">

            <?php } else { ?>

                <div id="add_computer" class="panel-collapse collapse">

            <?php } ?>

            <div class="panel-body">

                <?php echo form_open('computers/computer_add'); ?>

                <div class="row">
                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Asset Type: What is it? A laptop, desktop or accessory? Required Field"> <label for="make_dropdown">Asset Type: </label></a><br>
                    <?php echo form_dropdown('make_dropdown', $make_dropdown, '', 'id="make_dropdown" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Model: The asset's model number? Required Field"> <label for="models">Model: </label></a><br>
                    <?php echo form_dropdown('model_id', $models, '', 'id="models" class="form-control input-sm"'); ?></div>

                    <div class="col-xs-12 col-md-3 required_hide">
                    <a class="tip" data-toggle="tooltip" data-placement="right" title="Serial Number: The asset's serial number. Required Field"> <?php echo form_label('Serial Number: ', 'serial_num3'); ?></a>
                    <?php echo form_input('serial_num', set_value("serial_num"), 'id="serial_num3"'); ?></div>

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
        <div class="additional-links"><b>Additional Links:</b> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#add_computer">Add New Computer</a> | <a href="<?php echo base_url();?>dashboard/computer_models">Add New Accessory</a> | <a href="<?php echo base_url();?>dashboard/computer_models">Add New Computer Model</a></div>
    </div>
</div>

<?php if (!$records) { ?>

<?php } else { ?>

<div class="hidden-xs">
	<div class="spacer_bar"></div>
	<div class="table hover_table">

		<?php echo $this->table->generate($records); ?>

		</br>

        <?php echo $this->pagination->create_links(); ?>

	</div>
</div>

<?php } ?>

<div class="container">
	<div class="row">
		<div class="hidden-xs hidden-sm">
			<div class="input-group pull-right">
				<?php echo form_open('computers/search'); ?>

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