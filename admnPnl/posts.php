<?php require_once '../include/inc.php'; ?>
<?php if (checkLogin()) : ?>
	<?php if (checkAdmin()) : ?>
		<?php get('header'); ?>
		<?php get('nav'); ?>
		<div class="container-fluid bg-img">
			<h1 class="display-1 font-weight-bold text-white p-5">/Admin/
				<?php title('heading'); ?>
			</h1>
		</div>
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<?php //showPosts();
			showTables('post'); ?>
				<?php addCate(); ?>
			</div>
		</div>
		<?php get('footer'); ?>
	<?php else : ?>
		<?php redirect(); ?>
	<?php endif; ?>
<?php else : ?>
	<?php redirect(); ?>
<?php endif; ?>