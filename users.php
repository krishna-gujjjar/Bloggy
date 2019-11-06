<?php require_once 'include/inc.php'; ?>
<?php if (checkLogin()) : ?>
	<?php get('header'); ?>
	<?php get('nav'); ?>
	<div class="container-fluid bg-img">
		<h1 class="display-1 font-weight-bold text-white p-5">/
			<?php echo ucwords('all'); ?> Users</h1>
	</div>
	<div class="container-fluid px-5">
		<div class="row pt-5">
			<?php //showAllTable(); 
		showUsers('users'); ?>
		</div>
	</div>
	<?php addFriend(); ?>
	<?php get('footer'); ?>
<?php else : ?>
	<?php redirect(); ?>
<?php endif; ?>

<?php
//Show User List Table
function showAllTable()
{ ?>
<div class="container-fluid bg-dark rounded text-center">
    <div class="row">
        <div class="col-md-12 px-0">
            <h1 class="display-4 py-3 font-weight-bold text-success">
                <?php echo ucwords('all') . ' Users'; ?>
            </h1>

            <table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
						<?php
					$i = 1;
					$userid = $_SESSION['userid'];
					$userQuery = run("SELECT * FROM user WHERE user.ustatus = '1' AND user.ulevel = '0' AND user.uid != '$userid' ORDER BY user.ufname ASC ");

					if (countData($userQuery)) {

						foreach ($userQuery as $data) { ?>
                    <tr>
                        <td scope="row" class="align-middle">
                            <?php $rid = $data['uid']; ?>
                            <?php echo $i++ . '.'; ?>
                        </td>
                        <td class="w-5 align-middle">
                            <?php profilePic($data['upic']); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo ucwords($data['ufname']); ?>
                        </td>
                        <td class="align-middle">
                        <?php $friendQuery = run("SELECT * FROM friends WHERE fstatus = '0' AND rid = '$rid' AND sid= '$userid'"); ?>
						<?php if (countData($friendQuery)) : ?>
							<a href="#">
                                <button class="btn btn-outline-info btn-lg">Request Sent</button>
                            </a>
						<?php else : ?>
                            <form action="">
                                <!-- <a href="query?addfriend="> -->
                                <button class="btn btn-outline-primary btn-lg" type="submit" name="addFriend" value="<?php echo $data['uid']; ?>">Add Friend</button>
                                <!-- </a> -->
                            </form>
                        <?php endif; ?>
                        </td>
                    </tr>
<?php 
}
} else { ?>
                    <tr>
                        <td colspan="8">
                            <h4 class="text-black-50">All User Requested.</h4>
                        </td>
                    </tr>
<?php 
} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

}
?>