<div class="row">
	<div class="col-xs-12 col-md-3">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<h1>Agents</h1>
		<p>Agents are additional users associated to your company. They have less permission, restricting them from the Dashboard.</p>

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="row">

		<?php echo form_open('dashboard/manage_agents'); ?>

		<?php if ($list_agents == null)
		{

		} else { ?>

			<div class="col-xs-12 col-md-6">
				<h3>Current agents:</h3>
				<?php echo form_dropdown('list_agents', $list_agents, '', 'id="list_agents" class="form-control"'); ?><br>
				<div class="checkbox_align"><?php echo form_label(form_checkbox($del_agent).'delete selected agent?', 'del_agent'); ?></div>
			</div>

		<?php } ?>

			<div class="col-xs-12 col-md-6">
				<h3>Add a new agent</h3>
				<h4>Enter the agents email address: </h4>
				<p><?php echo form_input('email', set_value('email', ''), 'id="email"'); ?></p>
				<h4>Enter the agents password: </h4>
				<p><?php echo form_input('password', '', 'id="password"'); ?></p>
			</div>
		</div>

		<?php if ($list_agents == null) { ?>

		<div class="row">
			<div class="col-xs-12 col-md-6">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'add new agent');
				echo form_submit($data);
				echo form_close(); ?>

		<?php } else { ?>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br>
				<?php $data = array('name' => 'go_agent', 'class' => 'btn btn-primary', 'type' => 'submit', 'value' => 'update');
				echo form_submit($data);
				echo form_close(); ?>

		<?php } ?>
			</div>
		</div>
		<div class="buff">
		To <b>ADD</b> an agent, enter an email address and a password, click submit.</br>
		To <b>RESET</b> an agent's password, select the agent from the dropdown above, enter a new password, and click submit.</br>
		To <b>DELETE</b> an agent, select the agent from the dropdown, check the box for delete, click submit.
		</div>

	</div>
</div>
</div>