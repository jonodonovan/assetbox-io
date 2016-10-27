<h2><?php echo $detail_value; ?></h2>
<?php if (!$query)
{ ?>

    <div class="alert alert-warning text-center">
        <h3>Sorry, no data to show.</h3>
        <h4>Not a problem, no mobile devices are on loan.</h4>
    </div>

<?php } else { ?>
<?php echo $this->table->generate($query); ?>
<?php } ?>
</br><a href="<?php echo base_url();?>dashboard/mobile"><i class="icon-arrow-left"> return to dashboard?</i></a></br></br></br></br></br></br>