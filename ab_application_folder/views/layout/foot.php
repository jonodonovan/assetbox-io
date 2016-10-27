</div>



<div class="foot-font">
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="foot">
			<div class="container">

				<?php $this->load->view('includes/foot_links.php'); ?>

			</div>
		</div>
	</div>
</div>


	<script src="<?php echo base_url(); ?>assets/scripts/jquery-1.10.2.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/bootstrap.min.js"></script>

	<?php if ($this->session->userdata('logged_in'))
	{ ?>

		<script src="<?php echo base_url(); ?>assets/scripts/main.js"></script>

	<?php } ?>

	<?php if ($this->uri->segment(2) === 'search' || $this->uri->segment(2) === 'detail') { ?>

			<script src="<?php echo base_url(); ?>assets/scripts/jquery.dataTables.js"></script>
			<script src="<?php echo base_url(); ?>assets/scripts/jquery.dataTables.columnFilter.js"></script>
			<script src="<?php echo base_url(); ?>assets/scripts/TableTools.min.js"></script>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function()
				    {
						$('#myTable').dataTable({
							"sDom": 'T<"clear">lfrtip',
							"oTableTools": {
								"sSwfPath": "/assets/scripts/extras/copy_csv_xls_pdf.swf"
							}

						});
				    });
			</script>

	<?php } ?>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-10717073-14', 'auto');
	  ga('send', 'pageview');

	</script>

	<?php //$this->output->enable_profiler(false); ?>
	<?php //echo CI_VERSION; ?>
</body>
</html>