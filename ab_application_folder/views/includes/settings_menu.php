<?php if ($this->uri->segment(1) == "settings") { } else { echo "<a href='/settings'><i class='icon-home'> settings home</i></a><hr>"; } ?>
<h4>Account Settings</h4>
<ul class="nav nav-pills nav-stacked">
	<li class="<?php if ( $sub_active_page == 'profile') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/profile">Profile Information</a></li>
	<!-- <li class="<?php if ( $sub_active_page == 'email') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/email">Email Settings</a></li> -->
	<li class="<?php if ( $sub_active_page == 'company') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/company">Company Information</a></li>
	<li class="<?php if ( $sub_active_page == 'agents') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/agents">Agents</a></li>

	<li class="<?php if ( $sub_active_page == 'subscription') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/subscription">

	<?php if (!$this->session->userdata('plan') == "onemonth") {
		echo "<span style='color:red !important;'>";
	} else {
		echo "<span>";
	} ?>

	Subscription</span></a></li>

</ul>
<h4>Asset Settings</h4>
<ul class="nav nav-pills nav-stacked">
	<li class="<?php if ( $sub_active_page == 'models') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/computer_models">Computer Models & Accessories</a></li>
	<li class="<?php if ( $sub_active_page == 'swmanu') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/software_manufacturers">Software Manufacturers</a></li>
	<li class="<?php if ( $sub_active_page == 'swname') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/software_names">Software Titles</a></li>
	<li class="<?php if ( $sub_active_page == 'momake') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/mobile_makes">Mobile Manufacturers</a></li>
	<li class="<?php if ( $sub_active_page == 'momodel') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/mobile_models">Mobile Models</a></li>
	<!-- <li class="<?php if ( $sub_active_page == 'uploadcenter') { echo "active"; } ?>"><a href="<?php echo base_url();?>dashboard/upload_center">Upload Center</a></li> -->
</ul>
<hr>
<div class="buff"></div>