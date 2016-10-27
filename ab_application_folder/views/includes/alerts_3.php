<div class="container">
	<div class="row">
		<div class="col-xs-12 center">
			<?php if (validation_errors()) { ?><div class="alert alert-danger"><?php echo validation_errors(); ?></div><?php } ?>
			<?php if ($this->session->flashdata('message')) { ?><div class="alert alert-success"><i class="icon-thumbs-up"> <?php echo $this->session->flashdata('message'); ?></i></div><?php } ?>
			<?php if ($this->session->flashdata('messagebold')) { ?><div class="alert alert-success"><?php echo $this->session->flashdata('messagebold'); ?></div><?php } ?>
			<?php if ($this->session->flashdata('messagebad')) { ?><div class="alert alert-danger"><?php echo $this->session->flashdata('messagebad'); ?></div><?php } ?>
            <?php if ($this->session->flashdata('sub')) { ?><div class="alert alert-danger"><?php echo $this->session->flashdata('sub'); ?></div><?php } ?>
		</div>
	</div>
</div>