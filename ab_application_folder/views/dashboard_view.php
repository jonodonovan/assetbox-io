<?php $this->load->view('includes/alerts_3.php'); ?>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">

        <?php if ($this->session->userdata('ccheck') == '1')
        { ?>

        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#computer">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="icon-desktop panel-fill"> Computer</i>
                </h4>
            </div>
        </a>

        <?php if ($this->uri->segment(2) === "computer")
        { ?>

        	<div id="computer" class="panel-collapse collapse in">

        <?php } else { ?>

        	<div id="computer" class="panel-collapse collapse">

        <?php } ?>

            <div class="panel-body">
				<div class="computers_db">
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>dashboard/detail/computers-in-stock">In stock <span class="badge"><?php echo $total_amount_pcn ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_pcn); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>stock/detail/assets-needing-warranty-repair">Warranty repair <span class="badge"><?php echo $total_amount_pri ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_pri); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>stock/detail/assets-needing-nonwarranty-repair">Non-warranty repair <span class="badge"><?php echo $total_amount_rpn ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_pcn_needsrepair); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>stock/detail/assets-out-for-repair">Being repaired <span class="badge"><?php echo $total_amount_ofr ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_pcn_repairout); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>stock/detail/assets-ready-for-recycling">Recycle & Decommissioned <span class="badge"><?php echo $total_amount_frc ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_pcn_recycle); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
				        	<h4><a href="<?php echo base_url();?>dashboard/detail/accessories-in-stock">Accessories in stock <span class="badge"><?php echo $total_amount_acc ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_acc); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
                    <hr>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<h4><a href="<?php echo base_url();?>dashboard/detail/computers-on-loan">Computers on Loan</a> <span class="badge"><?php echo $comp_temp_count ?></span></h4>
							<?php $this->table->set_heading('Serial', 'Return Date (within 7 days)', ''); ?>
							<?php echo $this->table->generate($comp_temp_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
                        <div class="col-xs-12 col-md-6">
                            <h4><a href="<?php echo base_url();?>dashboard/detail/computers-not-in-stock">Computers Not in Stock</a> <span class="badge"><?php echo $comp_out_count ?></span></h4>
                            <?php $this->table->set_heading('Model', 'Amount', ''); ?>
                            <?php echo $this->table->generate($comp_out_rows); ?>
                            <?php $this->table->clear(); ?>
                        </div>
					</div>
				</div>
            </div>
        <br>
    	</div>
    </div>
    <div class="panel panel-default">
    <?php } ?>

        <?php if ($this->session->userdata('scheck') == '1')
        { ?>

        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#software">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="icon-puzzle-piece panel-fill"> Software</i>
                </h4>
            </div>
        </a>

        <?php if ($this->uri->segment(2) === "software")
        { ?>

        	<div id="software" class="panel-collapse collapse in">

        <?php } else { ?>

        	<div id="software" class="panel-collapse collapse">

        <?php } ?>

            <div class="panel-body">

				<div class="software_db">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<h4><a href="<?php echo base_url();?>dashboard/detail/software-in-stock">Software in stock <span class="badge"><?php echo $total_amount_software ?></span></a></h4>
							<?php $this->table->set_heading('Title', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_software); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-6">
							<h4><a href="<?php echo base_url();?>dashboard/detail/software-installed">Software installed <span class="badge"><?php echo $total_amount_software_installed ?></span></a></h4>
							<?php $this->table->set_heading('Title', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_software_installed); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
                    <hr>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<h4>Licenses Ending <span class="badge"><?php echo $led_count ?></span></h4>
							<?php $this->table->set_heading('License', 'End Date', ''); ?>
							<?php echo $this->table->generate($led_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-6">
							<h4>Support Ending <span class="badge"><?php echo $sed_count ?></span></h4>
							<?php $this->table->set_heading('License', 'End Date', ''); ?>
							<?php echo $this->table->generate($sed_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
				</div>
            </div>
        <br>
        </div>
    </div>
    <div class="panel panel-default">
    <?php } ?>

        <?php if ($this->session->userdata('mcheck') == '1')
        { ?>

        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#mobile">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="icon-tablet panel-fill"> Mobile</i>
                </h4>
            </div>
        </a>

        <?php if ($this->uri->segment(2) === "mobile")
        { ?>

        	<div id="mobile" class="panel-collapse collapse in">

        <?php } else { ?>

        	<div id="mobile" class="panel-collapse collapse">

        <?php } ?>

            <div class="panel-body">

				<div class="mobile_db">
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>dashboard/detail/mobile-in-stock">In stock <span class="badge"><?php echo $total_amount_mobile ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_mobile); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>dashboard/detail/mobile-needs-repair">Needs Repair <span class="badge"><?php echo $total_amount_mobile_needsrepair ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_mobile_needsrepair); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4><a href="<?php echo base_url();?>dashboard/detail/mobile-recycle">Recycle <span class="badge"><?php echo $total_amount_mobile_recycle ?></span></a></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($stockrecords_mobile_recycle); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
                    <hr>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<h4>Mobile - Contract(s) Ending <span class="badge"><?php echo $ced_count ?></span></h4>
							<?php $this->table->set_heading('Device ID', 'End Date'); ?>
							<?php echo $this->table->generate($ced_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-6">
							<h4>Mobile - Contract(s) Upgrades <span class="badge"><?php echo $crd_count ?></span></h4>
							<?php $this->table->set_heading('Device ID', 'End Date'); ?>
							<?php echo $this->table->generate($crd_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
                    <hr>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<h4><a href="<?php echo base_url();?>dashboard/detail/mobiles-on-loan">Mobiles on Loan</a> <span class="badge"><?php echo $mobile_temp_count ?></span></h4>
							<?php $this->table->set_heading('Serial', 'Return Date (within 7 days)', ''); ?>
							<?php echo $this->table->generate($mobile_temp_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
				</div>
            </div>
        <br>
        </div>
    </div>

    <div class="panel panel-default">

    <?php } ?>

        <a class="accordion-toggle black" data-toggle="collapse" data-parent="#accordion" href="#profile">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="icon-bar-chart panel-fill"> Profile Stats</i>
                </h4>
            </div>
        </a>

        <div id="profile" class="panel-collapse collapse">
            <div class="panel-body">

				<div class="profile_db">
					<div class="row text-center">
						<div class="col-xs-6 col-md-3">
							<h4>Unique Computers:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_computers ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Unique Accessories:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_accs ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Unique Software:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_swnames ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Unique Mobile devices:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_mobile ?></p>
						</div>
					</div>
					<br>
					<div class="row center">
						<div class="col-xs-6 col-md-3">
							<h4>Actions in 1 week:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_actions_oneweek ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Actions in 4 weeks:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_actions_fourweek ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Actions in 12 months:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_actions_onemonth ?></p>
						</div>

						<div class="col-xs-6 col-md-3">
							<h4>Total Number of Actions:</h4>
							<p class="btn btn-large btn-primary disabled"><?php echo $us_total_actions ?></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<h4>Top Computer Models <span class="badge"><?php echo $computer_count ?></span></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($computer_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4>Top Software Titles <span class="badge"><?php echo $software_count ?></span></h4>
							<?php $this->table->set_heading('Title', 'Amount'); ?>
							<?php echo $this->table->generate($software_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
						<div class="col-xs-12 col-md-4">
							<h4>Top Mobile Models <span class="badge"><?php echo $mobile_count ?></span></h4>
							<?php $this->table->set_heading('Model', 'Amount'); ?>
							<?php echo $this->table->generate($mobile_rows); ?>
							<?php $this->table->clear(); ?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<br><br>