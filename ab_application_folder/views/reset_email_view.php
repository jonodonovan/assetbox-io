
    <?php echo form_open('login/check', array('class' => 'white-popup-block mfp-hide', 'id' => 'login-form')); ?>
    <div>
    <h1>Hello, welcome back!</h1>
    <div class="alert alert-block alert_fix"><strong>Each field is required</strong></div><br>
    <p><?php echo form_label('Email Address: ', 'email'); echo form_input('email', ''); ?></p>
    <p><?php echo form_label('Password: ', 'password'); echo form_password('password', ''); ?></p>

    	<?php
    	$data = array(
    		'name' => 'submit',
    		'class' => 'btn btn-large btn-primary',
    		'type' => 'submit',
    		'value' => 'Login'
    	);

    echo form_submit($data); ?>
    </div>