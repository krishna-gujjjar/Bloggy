<?php require_once '../include/inc.php'; ?>
<?php if (checkLogin()) : ?>
	<?php if (checkAdmin()) : ?>
		<?php if (create('user')) : ?>
			<?php get('header'); ?>
			<?php get('nav'); ?>
			<div class="container-fluid bg-img">
				<h1 class="display-1 font-weight-bold text-white p-5">/Admin/
					<?php echo ucwords($_REQUEST['user']); ?> Users</h1>
			</div>
			<div class="container-fluid px-5">
				<div class="row pt-5">
					<?php showTables('user', $_REQUEST['user']); ?>
				</div>
			</div>
			<?php get('footer'); ?>
		<?php else : ?>
			<?php redirect('admnPnl/'); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php redirect(); ?>
	<?php endif; ?>
<?php else : ?>
	<?php redirect(); ?>
<?php endif; ?>