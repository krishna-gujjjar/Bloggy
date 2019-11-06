<?php require_once '../include/inc.php'; ?>
<?php if (checkLogin() && create('active') || create('block') || create('delete') || create('cate_active') || create('cate_deactive') || create('cate_delete') || create('post_update') || isset($_REQUEST['addfriend'])) : ?>
	<?php userAction(); ?>
	<?php cateAction(); ?>
	<?php updatePost(); ?>
	<?php addfriend(); ?>
	<!-- <script>window.location = "<?php //url() . print('admnPnl/'); ?>";</script> -->
<?php else : ?>
	<?php redirect('admnPnl/'); ?>
<?php endif; ?>