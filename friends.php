<?php require_once 'include/inc.php'; ?>
<?php if (checkLogin() && inFriend()) : ?>
<?php get('header'); ?>
<?php get('nav'); ?>
<div class="container-fluid bg-img">
	<h1 class="display-1 font-weight-bold text-white p-5">/All Friends</h1>
</div>
<div class="container-fluid px-5">
	<div class="row pt-5">
		<?php showUsers('friends'); ?>
	</div>
</div>
<?php addFriend(); ?>
<?php get('footer'); ?>
<?php else : ?>
<?php redirect(); ?>
<?php endif; ?>