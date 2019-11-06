<?php session_start(); ?>
<?php date_default_timezone_set('Asia/Kolkata'); //Local Timezone
?>
<?php //Local Root url
function url()
{
	return print('http://localhost/speed_code/day03(BlogChat)/');
} ?>
<?php //Getting Favicons
function get_favicon()
{ ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php url(); ?>assets/img/logo/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php url(); ?>assets/img/logo/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php url(); ?>assets/img/logo/favicon-16x16.png">
	<link rel="manifest" href="<?php url(); ?>assets/img/logo/site.webmanifest">
	<link rel="mask-icon" href="<?php url(); ?>assets/img/logo/safari-pinned-tab.svg" color="#fc5c65">
	<link rel="shortcut icon" href="<?php url(); ?>assets/img/logo/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="Bloggy">
	<meta name="application-name" content="Bloggy">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-config" content="<?php url(); ?>assets/img/logo/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
<?php } ?>


<?php //Getting Linked StyleSheets
function get_style()
{ //Local Stylesheets
	?>
	<link rel="stylesheet" href="<?php url(); ?>vendor/nprogress/nprogress.css">
	<link rel="stylesheet" href="<?php url(); ?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php url(); ?>vendor/fa/css/all.min.css">
	<script src="<?php url(); ?>vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.6.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/nprogress@0.2.0/nprogress.min.css,npm/bootstrap@4.2.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.1/dist/sweetalert2.all.min.js"></script> -->

	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="<?php url(); ?>assets/style/main.css">
<?php } ?>

<?php //Getting Linked Scripts
function get_script()
{ //Local Scripts
	?>
	<script src="<?php url(); ?>vendor/nprogress/nprogress.js"></script>
	<script src="<?php url(); ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php url(); ?>vendor/jquery-form/dist/jquery.form.min.js"></script>
	<script src="<?php url(); ?>vendor/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php url(); ?>vendor/jquery-validation/dist/additional-methods.min.js"></script>
	<script src="<?php url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- <script src="https://cdn.jsdelivr.net/combine/npm/nprogress@0.2.0,npm/jquery@3.3.1,npm/bootstrap@4.2.1/dist/js/bootstrap.bundle.min.js,npm/jquery-validation@1.19.0,npm/jquery-validation@1.19.0/dist/additional-methods.min.js,npm/jquery-form@4.2.2"></script> -->

	<!-- Custom Javascript -->
	<script src="<?php url(); ?>assets/js/main.js"></script>
<?php } ?>