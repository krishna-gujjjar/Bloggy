<?php require_once 'include/inc.php'; ?>
<?php if (checkLogin()) : ?>
	<?php get('header'); ?>
	<?php get('nav'); ?>
	<div class="container pt-3 bg-light" id="main">
		<!-- <div class="row mt-5">
			<div class="col-sm-12" > -->
				<div id="<?php //profile?>">
					<div class="media rounded-pill mt-5 mx-lg-n5 bg-cover" style="background:linear-gradient( var(--softDark),  var(--softDark)), url('<?php url(); ?>assets/img/bg.jpg') ">
						<img class="align-self-start rounded-circle w-25 m-5" src="<?php url(); ?>assets/img/user.png" alt="">
						<div class="media-body align-self-end pb-5">
							<h1 class="display-1 font-weight-bold text-light">Krishna Gujjjar</h1>
						</div>
					</div>
					
				</div>
			<!-- </div>
		</div> -->
	</div>
	<?php get('footer'); ?>
<?php else : ?>
	<?php redirect(); ?>
<?php endif; ?>
