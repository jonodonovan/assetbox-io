<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="A desktop, laptop, computer accessory, software, and mobile device asset inventory management tool">
<meta name="keywords" content="asset tracking, asset management, desktop, notebook, software, mobile device, inventory">
<meta name="robots" content="index, nofollow">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, user-scalable=no">

<meta property="og:site_name" content="Asset Box" />
<meta property="og:title" content="AssetBox.io" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://assetbox.io" />
<meta property="og:image" content="<?php echo base_url() ?>assets/images/apple-icon-144x144.png" />
<meta property="og:description" content="A desktop, laptop, computer accessory, software, and mobile device asset inventory management tool" />

<title>AssetBox.io
    <?php if ( $active_page === 'home') { echo "| Login"; } ?>
	<?php if ( $active_page === 'computers') { echo "| Computers"; } ?>
	<?php if ( $active_page === 'software') { echo "| Software"; } ?>
	<?php if ( $active_page === 'mobile') { echo "| Mobile"; } ?>
	<?php if ( $active_page === 'stock') { echo "| Stock"; } ?>
    <?php if ( $active_page === 'settings') { echo "| Settings"; } ?>
	<?php if ( $active_page === 'dashboard') { echo "| Dashboard"; } ?>
		<?php if ( $sub_active_page === 'profile') { echo "- Profile Edit"; } ?>
		<?php if ( $sub_active_page === 'email') { echo "- Email Edit"; } ?>
		<?php if ( $sub_active_page === 'company') { echo "- Company Edit"; } ?>
		<?php if ( $sub_active_page === 'agents') { echo "- Agents Edit"; } ?>
		<?php if ( $sub_active_page === 'models') { echo "- Model Edit"; } ?>
		<?php if ( $sub_active_page === 'swmanu') { echo "- Software Manufacturers Edit"; } ?>
		<?php if ( $sub_active_page === 'swname') { echo "- Software Title Edit"; } ?>
		<?php if ( $sub_active_page === 'momake') { echo "- Mobile Make Edit"; } ?>
		<?php if ( $sub_active_page === 'momodel') { echo "- Mobile Model Edit"; } ?>
		<?php if ( $sub_active_page === 'search') { echo " Search"; } ?>
	<?php if ( $active_page === 'search') { echo " Searchs"; } ?>
	<?php if ( $active_page === 'about') { echo "| About"; } ?>
	<?php if ( $active_page === 'itemprofile') { echo "| Item Profile"; } ?>
	<?php if ( $active_page === 'contact') { echo "| Contact Us"; } ?>
	<?php if ( $active_page === '404') { echo "| Error 404"; } ?>
	<?php if ( $active_page === 'passwordreset') { echo "| Password Reset"; } ?>
	<?php if ( $active_page === 'passwordreset_new') { echo "| New Password"; } ?>

</title>

<!--[if lt IE 9]>
	<link href="<?php echo base_url() ?>assets/css/main_ie.min.css" rel="stylesheet" type="text/css">
<![endif]-->

<!--[if ! lt IE 9]><!-->
	<link href="<?php echo base_url() ?>assets/css/main.min.css" rel="stylesheet" type="text/css">
<!--<![endif]-->

<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() ?>assets/images/ab-144x144.png">

<link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<?php if ($this->uri->segment(2) === 'search' || $this->uri->segment(2) === 'detail') { ?>
<link href="<?php echo base_url() ?>assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/TableTools.css" rel="stylesheet" type="text/css">
<?php } ?>

<script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("https")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
    <noscript>
        <div id="no-script">
            <div id="message">
                <h2>Hello!</h2>
                <p>It looks like your Javascript isn't working.<br/>
                To use this site, you’ll have to enable it.</p>
            </div>
        </div>
    </noscript>

	<?php if (!$this->session->userdata('logged_in')): ?>

	<?php $this->load->view('includes/account_modal.php'); ?>

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container padding">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <div>Menu</div>
                </button>
                <a class="logo navbar-brand" href="<?php echo base_url();?>welcome"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url();?>about" class="<?php if ( $active_page == 'about') { echo "btn btn-default active"; } echo "btn btn-default"; ?>">About</a></li>
                    <li><a data-toggle="modal" href="#pricingModal" class="btn btn-default">Pricing</a></li>
                    <li><a data-toggle="modal" href="#signupmodal" class="btn btn-large btn-success btn-block button-white-text">Get started</a></li>
                    <li><a data-toggle="modal" href="#loginmodal" class="btn btn-default">Login</a></li>
                </ul>
            </div>
        </div>
    </div>

	<?php else : ?>

	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<div class="menu">MENU</div>
				</button>
				<a class="logo navbar-brand" href="<?php echo base_url();?>dashboard"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">

                    <?php if ($this->session->userdata('ccheck') == '1')
                    { ?>

					<li>
						<div class="test2">
							<a href="<?php echo base_url();?>computers" class="tip <?php if ( $active_page == 'computers') { echo "main-menu-active"; } ?>" data-toggle="tooltip" data-placement="bottom" title="Computers"><i class="icon-desktop icon-large"></i></a>
						</div>
					</li>
					<li class="hidden-md hidden-lg">
						<a href="<?php echo base_url();?>computers" class="btn btn-default bold-menu-text">Computers</a>
					</li>

                    <?php } ?>

                    <?php if ($this->session->userdata('scheck') == '1')
                    { ?>

                        <li>
                            <div class="test2">
                                <a href="<?php echo base_url();?>software" class="tip <?php if ( $active_page == 'software') { echo "main-menu-active"; } ?>" data-toggle="tooltip" data-placement="bottom" title="Software"><i class="icon-puzzle-piece icon-large"></i></a>
                            </div>
                        </li>
                        <li class="hidden-md hidden-lg">
                            <a href="<?php echo base_url();?>software" class="btn btn-default bold-menu-text">Software</a>
                        </li>

                    <?php } ?>

                    <?php if ($this->session->userdata('mcheck') == '1')
                    { ?>

					<li>
						<div class="test2">
							<a href="<?php echo base_url();?>mobile" class="tip <?php if ( $active_page == 'mobile') { echo "main-menu-active"; } ?>" data-toggle="tooltip" data-placement="bottom" title="Mobile"><i class="icon-mobile-phone icon-large"></i> <i class="icon-tablet icon-large"></i></a>
						</div>
					</li>
					<li class="hidden-md hidden-lg">
						<a href="<?php echo base_url();?>mobile" class="btn btn-default bold-menu-text">Mobile</a>
					</li>

                    <?php } ?>

					<?php if ($this->session->userdata('is_agent') == '0')
					{ ?>

                        <?php if ($this->session->userdata('mcheck') == '1' || $this->session->userdata('scheck') == '1' || $this->session->userdata('ccheck') == '1')
                        { ?>
        					<li>
        						<div class="test2">
        							<a href="<?php echo base_url();?>dashboard" class="tip <?php if ( $active_page == 'dashboard') { echo "main-menu-active"; } ?>" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="icon-bar-chart icon-large"></i></a>
        						</div>
        					</li>
        					<li class="hidden-md hidden-lg">
        						<a href="<?php echo base_url();?>dashboard" class="btn btn-default bold-menu-text">Dashboard</a>
        					</li>

                    <?php } ?>


					<li>
						<div class="test2">
						<a href="<?php echo base_url();?>settings" class="tip <?php if ( $active_page == 'settings') { echo "main-menu-active"; } ?>" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="icon-cog icon-large"></i></a>
						</div>
					</li>
					<li class="hidden-md hidden-lg">
						<a href="<?php echo base_url();?>settings" class="btn btn-default bold-menu-text">Settings</a>
					</li>

					<?php } ?>

					<li>
						<div class="test2">
							<a href="<?php echo base_url();?>logout" class="tip" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="icon-signout icon-large"></i></a>
						</div>
					</li>
					<li class="hidden-md hidden-lg">
						<a href="<?php echo base_url();?>logout" class="btn btn-default">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">

<?php endif; ?>