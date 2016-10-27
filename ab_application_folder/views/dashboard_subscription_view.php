<?php require_once('./config.php'); ?>

<div class="row">
    <div class="col-xs-3 hidden-xs hidden-sm">
        <?php $this->load->view('includes/settings_menu.php'); ?>
    </div>

    <div class="col-xs-12 col-sm-9 vline">
        <?php $this->load->view('includes/alerts_3.php'); ?>
        <br>
        <h1>Subscription Option</h1>
    </div>


    <?php if ($this->session->userdata('plan') == "oneyear")
    {
        echo "

        <div class='col-md-9'>
        Yearly Membership, <b>thank you!</b>
        </div>

        ";

    } else if ($this->session->userdata('plan') == "onemonth") {

        echo "

        <div class='col-xs-9'>
        Monthly Membership, <b>thank you!</b><br><br>
        Need help with your account? <a href='mailto:support@assetbox.io?Subject=Account%20help'>Email Support support@assetbox.io</a> or <a href='/contact'>submit a contact form</a>
        </div>

        ";

    } else { ?>

    <div class="col-md-1"></div>

    <div class="col-xs-6 col-md-6">
        <h3>Monthly</h3>
        <h3>$27<span class="price-cents">00</span><span class="price-month">per month</span></h3>

        <div>Affordible monthly plan</div>
        <div>Unlimited Computers</div>
        <div>Unlimited Software Titles</div>
        <div>Unlimited Mobile Devices</div>
        <div>Unlimited Searchs, Reports, and Exporting</div>
        <div>Unlimited Email Support</div>
        <div>CSV Import</div>
        <br>

        <?php echo form_open('dashboard/payment_process_month'); ?>

        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"

            data-email="<?php echo $this->session->userdata('email', TRUE); ?>"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-amount="2700"
            data-description="One month's subscription">

        </script>

        <?php echo form_close(); ?>

    </div>
    <div class="col-xs-9 text-center">
        <br><br>
        <img src="<?php echo base_url() ?>assets/images/credit-card-icons.png" alt="">
        <br><br><p><b>Don't worry. This process is 100% secure. Your private credit card data will never touch our servers.</b></p>
    </div>

    <?php } ?>
    <?php $this->load->view('includes/delete_account.php'); ?>

    <div class="col-xs-9 text-center">
        <br><br><br><br><br>
        <a class="btn btn-danger" href="#delete-account" data-toggle="modal">Delete account</a>
    </div>
</div>