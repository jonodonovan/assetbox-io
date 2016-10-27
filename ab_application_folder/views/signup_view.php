<div class="container">
    <?php $this->load->view('includes/alerts_3.php'); ?>

    <h2>Create Your Account</h2>

    <?php echo form_open('signup', array('id' => 'register-form')); ?>

    <p><?php echo form_label('Email Address: ', 'email');
    $register_email = array('type' => 'email','name' => 'email','id' => 'email','value' => '','placeholder' => 'example@assetbox.io','autofocus'   => 'autofocus', 'required' => 'required');
    echo form_input($register_email); ?></p>
    <div class="important">Important: This email address is used as your username and for invoicing.</div>

    <p><?php echo form_label('Password: ', 'password');
    $register_password = array('type' => 'password','name' => 'password','id' => 'password','value' => '','placeholder' => 'Password','required' => 'required');
    echo form_password($register_password); ?></p>

    <p><?php echo form_label('Confirm Password: ', 'cpassword');
    $register_cpassword = array('type' => 'cpassword','name' => 'cpassword','id' => 'cpassword','value' => '','placeholder' => 'Confirm Password','required' => 'required');
    echo form_password($register_cpassword); ?></p>

    <p>By clicking "Continue", you agree to our <b><a href="<?php echo base_url(); ?>legal/privacy" target="_blank">privacy policy</a></b> & <b><a href="<?php echo base_url(); ?>legal/tos" target="_blank">terms of service</a></b> and understand we may send you email regarding AssetBox.io.</p>
    <button type="submit" class="btn btn-success btn-lg">Continue</button>


    <?php echo form_close(); ?>

</div>
<div class="hidden-md hidden-lg">
    <div class="buff"></div>
</div>