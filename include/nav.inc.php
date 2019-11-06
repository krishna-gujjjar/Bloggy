<header class="fixed-top" id="head">
<?php checkProfile(); ?>
<nav class="navbar navbar-expand-sm navbar-light py-3 bg-white shadow-sm px-5 mx-md-0 mx-n3">
<!-- <nav class="navbar navbar-expand-sm navbar-dark py-3 bg-primary px-5"> -->
	<a class="navbar-brand font-weight-bold" href="<?php url(); ?>">Bloggy</a>

	<button class="navbar-toggler d-lg-none border-0 mx-md-0 mr-n4" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fas fa-ellipsis-h fa-rotate-90"></i>
		
	</button>

	<div class="collapse navbar-collapse" id="collapsibleNavId">
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item <?php active('index'); ?> mr-3 my-2 my-lg-0">
				<a class="nav-link font-weight-bold" href="<?php url(); ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item mr-3 my-2 my-lg-0">
				<a class="nav-link font-weight-bold" <?php modal('about'); ?>>
				<i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
				About</a>
			</li>

			<?php if (checkLogin()) : //User Loged In (1st Condition Starts) ?>
				<?php if (checkAdmin()) : //Admin Loged In (2nd Condition Starts) ?>
					<?php welcome('Admin'); //Message ?>
					<?php if (!strpos($_SERVER['PHP_SELF'], 'admnPnl/index')) : //Admin Locate on Admin Folder (3rd Condition Starts) ?>
						<?php if (strpos($_SERVER['PHP_SELF'], 'admnPnl/update')) : //Admin Locate on Update Page (4th Condition Starts) ?>
							<li class="nav-item mr-3 my-2 my-lg-0">
								<a class="nav-link font-weight-bold" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
									<i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Go Back
								</a>
							</li>
						<?php else : //Admin Locate on Admin Folder but Not on Update Page (4th Condition else)?>
							<li class="nav-item mr-3 my-2 my-lg-0">
								<a class="nav-link font-weight-bold" href="<?php url(); ?>admnPnl/">
									<i class="fa fa-toggle-on fa-lg" aria-hidden="true"></i> Dashboard
								</a>
							</li>
						<?php endif; //(4th Condition Ends) ?>
					<?php endif; //(3rd Condition Ends) ?>
				<?php else : //Login as a User, Not Admin (2nd Condition Else) ?>
					<?php welcome(); ?>
					<li class="nav-item <?php active('profile'); ?> btn-group mr-3 my-2 my-lg-0">



						<span class="nav-link font-weight-bold dropdown-toggle" data-target="#profileCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="profileCollapse">
							<i class="fas fa-user-edit fa-lg"></i>
							<?php echo 'Hello ' . $_SESSION['userName']; ?>&nbsp;
							<?php if (newRecords('total')) : //Any New Notification Found ?>
								<span class="badge badge-danger rounded-pill rounded-pill text-white">
									<?php echo newRecords('total'); //Show Notification ?>
								</span>
							<?php endif; ?>
						</span>
						<ul id="profileCollapse" class="shadow-sm collapse list-group list-group-flush position-absolute mt-5">
							<li class="list-group-item list-group-item-action list-group-item-light">
								<a class="nav-link font-weight-bold" href="<?php url(); ?>profile">
								<i class="fas fa-user-edit fa-lg"></i> 
								&nbsp;Profile
							</a>
							</li>
							<li class="list-group-item list-group-item-action list-group-item-light">
								<?php if (inFriend()) : //If User Have Friends or Requests (5th Condition Starts) ?>
								<a class="nav-link font-weight-bold" href="<?php url(); ?>friends">
									<i class="fas fa-user-friends fa-lg"></i> 
									&nbsp;Friends 
									<?php if (newRecords('friends')) : //New Friend Request Found ?>
										<span class="badge badge-danger rounded-pill text-white ml-1">
											<?php echo newRecords('friends'); ?>
										</span>
									<?php endif; ?>
								</a>
							<?php endif; //(5th Condition Ends) ?>
							</li>
							<li class="list-group-item list-group-item-action list-group-item-light">
								<a class="nav-link font-weight-bold" href="<?php url(); ?>users">
								<i class="fa fa-users fa-lg"></i> 
								&nbsp;Users 
								<?php if (newRecords('users')) : //New User Account create ?>
									<span class="badge badge-danger rounded-pill text-white ml-1">
										<?php echo newRecords('users'); ?>
									</span>
								<?php endif; ?>
							</a>
							</li>
							<li class="list-group-item list-group-item-action list-group-item-light">
								<a class="nav-link font-weight-bold" href="<?php url(); ?>messages">
								<i class="far fa-envelope fa-lg" aria-hidden="true"></i> 
								&nbsp;Messages 
								<?php if (newRecords('messages')) : ?>
									<span class="badge badge-danger rounded-pill text-white ml-1">
										9
									</span>
								<?php endif; ?>
							</a>
							</li>
						</ul>
						







					</li>
				<?php endif; //(2nd Conditon Ends) ?>
				<li class="nav-item">
					<a class="nav-link font-weight-bold" href="<?php url(); ?>?logout"><i class="fa fa-power-off fa-lg" aria-hidden="true"></i> Logout</a>
				</li>
			<?php else : //User Not Loged In (1st Conditon Else) ?>
				<li class="nav-item mr-3 my-2 my-lg-0">
					<a class="nav-link font-weight-bold" <?php modal('signInModal'); ?>>
						<i class="fa fa-user-plus" aria-hidden="true"></i> Sign In
					</a>
				</li>
				<li class="nav-item mr-3 my-2 my-lg-0">
					<a class="nav-link font-weight-bold" <?php modal('signUpModal'); ?>>
						<i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up
					</a>
				</li>
			<?php endif; //(1st Condition Ends) ?>
		</ul>
	</div>
</nav>

</header>
<div class="mt-5 mx-auto">