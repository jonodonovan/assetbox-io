<div class="modal fade" id="loginmodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

            <?php echo form_open('login/check', array('id' => 'login-form')); ?>

            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 id="modal-title">Hello, welcome back!</h2>
			</div>

			<div class="modal-body">

				<p><?php echo form_label('Email Address: ', 'email');
				$login_email = array('type' => 'email','name' => 'email','id' => 'loginemail','value' => '','placeholder' => 'example@assetbox.io','autofocus'   => 'autofocus', 'required' => 'required');
				echo form_input($login_email); ?></p>

				<p><?php echo form_label('Password: ', 'password');
				$login_password = array('type' => 'password','name' => 'password','id' => 'loginpassword','value' => '','placeholder' => 'Password','required' => 'required');
				echo form_password($login_password); ?></p>

			</div>

			<div class="modal-footer">

                <p>By clicking "Login", you agree to our <b><a href="<?php echo base_url(); ?>legal/privacy" target="_blank">privacy policy</a></b> & <b><a href="<?php echo base_url(); ?>legal/tos" target="_blank">terms of service</a></b> and understand we may send you email regarding AssetBox.io.</p>
				<?php $data = array('name' => 'submit','class' => 'btn btn-primary btn-lg','type' => 'submit','value' => 'Login');
				echo form_submit($data); ?>

			</div>

			<?php echo form_close(); ?>

			<div class="login-help">
				<a href="<?php echo base_url();?>login/reset">Forgot Password?</a> | <a href="<?php echo base_url(); ?>contact">Need help? Contact Support</a>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="sharemodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 id="myModalLabel">Help us grow!</h2>
			</div>

			<div class="modal-body">
				<div class="social">

					<a class="social-fb" href="#"
						  onclick="
							window.open(
							'https://www.facebook.com/sharer/sharer.php?u=assetbox.io',
							'facebook-share-dialog',
							'width=626,height=436');
							return false;">
							<i class="icon-facebook"> share</i>
					</a>
					<a class="social-tw" href="#"
						  onclick="
							window.open(
							'http://twitter.com/share?url=http://www.assetbox.io',
							'width=626,height=436');
							return false;">
							<i class="icon-twitter"> tweet</i>
					</a>
					<a class="social-li" href="#"
						  onclick="
							window.open(
							'http://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.assetbox.io',
							'width=626,height=436');
							return false;">
							<i class="icon-linkedin"> add</i>
					</a>
                    <br><br>
					<a class="social-g" href="https://plus.google.com/113940271176230140547" rel="publisher">Google+</a>
					<a class="social-sign-up" href="#signupmodal" data-toggle="modal">Create an account</a>

				</div>
			</div>
			<div class="modal-footer">
				<p>Thank you for your support!</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="pricingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header remove-border">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
      <div class="modal-body">
        <div class="col-sm-6">
          <div class="panel panel-default text-center plan-panel">
            <div class="panel-heading panel-background">
              <h3>Monthly</h3>
            </div>
            <div class="panel-body">
              <h3 class="panel-title price plan-panel-title">$27<span class="price-cents">00</span><span class="price-month">per month</span></h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item">Affordible monthly plan</li>
              <li class="list-group-item">Unlimited Computers</li>
              <li class="list-group-item">Unlimited Software Titles</li>
              <li class="list-group-item">Unlimited Mobile Devices</li>
              <li class="list-group-item">Unlimited Search, Reports, and Exporting</li>
              <li class="list-group-item">Unlimited Email Support</li>
              <li class="list-group-item">CSV Import</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-footer remove-border">
        <p><a class="btn btn-success btn-lg" href="#signupmodal" data-toggle="modal">Create an account</a></p>
        <b>Get started today, no credit card needed to start.</b>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="signupmodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<?php echo form_open('signup', array('id' => 'register-form')); ?>

            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 id="myModalLabel">Create Your Account</h2>
			</div>

			<div class="modal-body">
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

			</div>

            <div class="modal-footer">
				<p>By clicking "Continue", you agree to our <b><a href="<?php echo base_url(); ?>legal/privacy" target="_blank">privacy policy</a></b> & <b><a href="<?php echo base_url(); ?>legal/tos" target="_blank">terms of service</a></b> and understand we may send you email regarding AssetBox.io.</p>
				<?php $data = array('name' => 'submit','class' => 'btn btn-success btn-lg','type' => 'submit','value' => 'Continue');
				echo form_submit($data); ?>
			</div>

            <?php echo form_close(); ?>

		</div>
	</div>
</div>
<div class="modal fade" id="videomodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <iframe width="100%" height="400" src="//www.youtube.com/embed/B4R1zH9-QF0?rel=0" frameborder="0" allowfullscreen></iframe>

        </div>
    </div>
</div>
