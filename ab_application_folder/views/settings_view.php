<div class="row">
	<div class="col-xs-3 col-md-3 hidden-xs hidden-sm">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>

	<div class="col-xs-12 col-md-9 vline">

		<?php $this->load->view('includes/alerts_3.php'); ?>

		<div class="container">
			<div class="row">

				<h1>Welcome <?php if ($this->session->userdata('name') == "") { echo $this->session->userdata('email'); } else { echo $this->session->userdata('name'); } ?></h1>
				<hr>

				<h3>Where would you like to get started?</h3><br>

					<div class="col-sm-12 col-md-4">

						<i class="icon-desktop icon-large"> Setup <a href="<?php echo base_url();?>dashboard/computer_models">computer models and accessories</a>:</i><br><br>

					</div>
					<div class="col-sm-12 col-md-4">

						<i class="icon-puzzle-piece icon-large"> Setup <a href="<?php echo base_url();?>dashboard/software_manufacturers">software manufacturers</a> and <a href="<?php echo base_url();?>dashboard/software_names">software titles</a>:</i><br><br>
					</div>
					<div class="col-sm-12 col-md-4">

						<i class="icon-tablet icon-large"> Setup <a href="<?php echo base_url();?>dashboard/mobile_makes">mobile manufacturers</a> and <a href="<?php echo base_url();?>dashboard/mobile_models">mobile models</a>:</i><br><br>

					</div>
				</div>
			<br><br>
			<div class="row alert text-center">
				<p>If you have questions or need help, email <a href="mailto:support@assetbox.io"><b>support@assetbox.io</b></a></p>

				<p><b>Account type:</b>

					<?php if ($this->session->userdata('plan') == "oneyear")
					{
						echo "Yearly Membership, <b>thank you!</b>";

					} else if ($this->session->userdata('plan') == "onemonth") {

						echo "Monthly Membership, <b>thank you!</b>";

					} else {

						echo "<a href='/dashboard/subscription' class='important'>Not subscribed, upgrade to avoid data loss.</a>";

					} ?>
				</p>
			</div>
		</div>
	</div>
</div>
<br><br>
<div class="row">
	<div class="col-xs-12 hidden-md hidden-lg">
		<?php $this->load->view('includes/settings_menu.php'); ?>
	</div>
</div>