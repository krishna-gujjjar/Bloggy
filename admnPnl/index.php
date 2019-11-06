<?php require_once '../include/inc.php'; ?>
<?php if (checkLogin()) : ?>
	<?php if (checkAdmin()) : ?>
		<?php get('header'); ?>
		<?php get('nav'); ?>
		<div class="container-fluid bg-img">
			<h1 class="display-1 font-weight-bold text-white p-5">/Admin</h1>
		</div>
		<div class="container-fluid px-5">
			<div class="row pt-5">

				<!-- Active User's Short Table -->
				<div class="col-sm-4 mb-5">
					<?php shortTable('active'); ?>
				</div>

				<!-- Pending User's Short Table -->
				<div class="col-sm-4 mb-5">
					<?php shortTable('panding'); ?>
				</div>

				<!-- Blocked User's Short Table -->
				<div class="col-sm-4 mb-5">
					<?php shortTable('block'); ?>
				</div>

				<!-- Short Category Table -->
				<div class="col-sm-4 mb-5">
					<?php shortTable('cate'); ?>
				</div>

				<!-- Short Post Table -->
				<div class="col-sm-8 mb-5">
					<?php shortTable('post'); ?>
				</div>

			</div>
		</div>
		<?php get('footer'); ?>
	<?php else : ?>
		<?php redirect(); ?>
	<?php endif; ?>
<?php else : ?>
	<?php redirect(); ?>
<?php endif; ?>