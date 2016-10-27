	<div class="row">
		<div class="col-md-8 footer copyright">

				<?php if ($this->session->userdata('logged_in'))
				{ ?>

					&copy; <?php echo date("Y"); ?> AssetBox.IO | <a href="<?php echo base_url(); ?>legal/privacy">Privacy Policy</a> | <a href="<?php echo base_url(); ?>legal/tos">TOS</a> | <a href="<?php echo base_url(); ?>contact">Contact</a>
					</div>

				<?php } else { ?>

					&copy; <?php echo date("Y"); ?> <a href="<?php echo base_url(); ?>">AssetBox.IO</a> | <a href="<?php echo base_url(); ?>legal/privacy">Privacy Policy</a> | <a href="<?php echo base_url(); ?>legal/tos">TOS</a> | <a href="<?php echo base_url(); ?>contact">Contact</a> | <a data-toggle="modal" href="#sharemodal">Help us grow!</a>
					</div>


				<?php } ?>



	</div>