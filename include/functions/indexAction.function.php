<?php
// Show New Two User's Short Table //*(Admin)*//
function shortTable($type) //$type = eg. 'cate', 'post', 'active', 'panding' & 'block'
{
	if ($type == 'cate') { // Show Category's Short Table
		$title = 'Category'; //Title For Page
		$class = 'info';//Background Color
		$url = 'category';//Redirecting Loction
	} elseif ($type == 'post') { //Show Post's Short Table
		$title = $type;
		$class = 'primary';
		$url = 'posts';
	} else {
		if ($type == 'panding') { //Panding User's Short Table
			$title = $type . ' Users';
			$class = 'warning';
			$status = 0;//User's Account Status
		} elseif ($type == 'active') { //Active User's Short Table
			$title = $type . ' Users';
			$class = 'success';
			$status = 1;
		} elseif ($type == 'block') { //Block User's Short Table
			$title = $type . ' Users';
			$class = 'danger';
			$status = 2;
		}
		$url = 'users?user=' . $type;
	} ?>
	<div class="card shadow rounded-lg border-light">
		<div class="card-header bg-<?php echo $class; ?> text-white text-center">
			<h3 class="card-title text-white">
				<?php echo ucwords($title); ?>
			</h3>
		</div>
		<div class="card-body text-center p-0 pb-3">
			<table class="table rounded text-center table-bordered table-hover table-responsive-md">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<?php if ($type == 'post') : ?>
						<th>Post Name</th>
						<th>Post Content</th>
						<?php elseif ($type == 'cate') : ?>
						<th>Category Name</th>
						<?php else : ?>
						<th>Username</th>
						<?php endif; ?>
						<th>Created Time</th>
					</tr>
				</thead>
				<tbody class="bg-light">
					<?php
				$i = 1;
				if ($type == 'post') {
					$shortQuery = run("SELECT * FROM post ORDER BY create_date DESC LIMIT 2");//Show Latest Two Post's Query
				} elseif ($type == 'cate') {
					$shortQuery = run("SELECT * FROM cate ORDER BY create_date DESC LIMIT 2");//Show Latest Two Category's Query
				} else {
					$shortQuery = run("SELECT * FROM user WHERE ustatus = '$status' AND ulevel = '0' ORDER BY create_date DESC LIMIT 2");//Show Latest Two User's Query 
				}

				if (countData($shortQuery)) :	//Chacking If Records Exist
				foreach ($shortQuery as $data) : ?>
					<tr>
						<td scope="row">
							<?php echo $i++ . '.'; ?>
						</td>
						<td>
							<?php if ($type == 'post') : ?>
							<a href="updatePost?post=<?php echo $data['pid']; ?>">
								<?php echo ucwords($data['pname']); ?>
							</a></td>
						<td>
							<?php trimPost($data['pcnt']); ?>
							<?php elseif ($type == 'cate') :
							echo ucwords($data['cname']);
						else :
							echo ucwords($data['ufname']);
						endif; ?>
						</td>
						<td>
							<?php showTime($data['create_date']); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else : //No Records Found in Database ?>
					<tr>
						<td colspan="3">
							<h4 class="text-black-50">No
								<?php echo ucwords($title); ?> Found.
							</h4>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<a href="<?php url() ?>admnPnl/<?php echo $url; ?>">
				<button class="btn btn-outline-primary btn-lg w-75">View All</button>
			</a>
		</div>
	</div>
	<?php

}

//Show All Type of User's List Table //*(Admin)*//
function showTables($type, $userType = null) //$type = eg. 'user', 'post', 'cate' & $userType = 'active', 'panding', 'block' 
{
	if (is_null($userType)) {
		$class = 'light';
		if ($type == 'post') {
			$name = 'Posts';
			$actionDelete = 'post_delete';
		} elseif ($type == 'cate') {
			$name = 'Categories';
			$actionDelete = 'cate_delete';
		}

	} elseif ($type == 'user') {
		$actionDelete = 'delete';
		if ($userType == 'active') {
			$btn = 2;
			$action = 'block';
			$btnName = ucwords($action);
			$class = 'success';
			$status = 1;
		} elseif ($userType == 'panding' || $userType == 'block') {
			$btn = 1;
			$action = 'active';
			$btnName = ucwords($action);
			if ($userType == 'panding') {
				$class = 'warning';
				$status = 0;
			} elseif ($userType == 'block') {
				$class = 'danger';
				$status = 2;
			}
		}
	} ?>
	<div class="container-fluid bg-dark rounded text-center shadow">
		<div class="row">
			<div class="col-md-12 px-0">
				<h1 class="display-4 py-3 font-weight-bold text-<?php echo $class; ?>">
					<?php if ($type == 'user') : ?>
					<?php echo ucwords($userType) . ' Users'; ?>
					<?php elseif ($type == 'post' || $type == 'cate') : ?>
					<div class="row">
						<div class="col-md-8">
							<?php echo ucwords($name); ?>
						</div>
						<div class="col-md-4">
							<span data-toggle="tooltip" data-placement="top" title="Add <?php echo $name; ?>">
							<a <?php if ($type == 'cate') {
										modal($type);
									} else { ?>href="
								<?php url(); ?>admnPnl/updatePost"
									<?php 
							} ?> >
								<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
							</a></span>
						</div>
					</div>
					<?php endif; ?>
				</h1>

				<table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
					<thead class="thead-light">
						<tr>
							<th>#</th>
							<?php 
						if ($type == 'user') {//User Table Heading ?>
							<th>Profile</th>
							<th>Username</th>
							<th>Email Address</th>
							<th>Mobile Number</th>
							<?php 
					} elseif ($type == 'cate' || $type == 'post') { //Cate & Post Table Heading ?>
							<?php if ($type == 'cate') : //Category ?>
							<th>Category Name</th>
							<?php elseif ($type == 'post') : //Post ?>
							<th>Image</th>
							<th>Post Name</th>
							<th>Category</th>
							<th>Post Content</th>
							<?php endif; ?>
							<th>Create By</th>
							<?php 
					} ?>
							<th>Created Time</th>
							<?php if ($type == 'user') : //User ?>
							<th>Last Login Time</th>
							<?php endif; ?>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="bg-light">
						<?php
					$i = 1;
					if ($type == 'cate') {
						$showData = run("SELECT cate.*, user.uid, user.ufname FROM cate LEFT JOIN user ON cate.uid = user.uid ORDER BY create_date DESC");
					} elseif ($type == 'post') {
						$showData = run("SELECT post.*, cate.cid, cate.cname, user.uid, user.ufname FROM post,cate,user WHERE post.cid = cate.cid AND post.uid = user.uid ORDER BY create_date DESC ");
					} elseif ($type == 'user') {
						$showData = run("SELECT * FROM user WHERE ustatus = '$status' AND ulevel = '0' ORDER BY create_date DESC ");
					}

					if (countData($showData)) { //Count Records in Database
						foreach ($showData as $data) {
							if ($type == 'user') { //User
								$id = $data['uid'];
							} elseif ($type == 'cate') { //Categories
								$id = $data['cid'];
								if ($data['cstatus'] == 1) { //Active Category
									$btn = 2;
									$btnName = 'Deactivate';
									$action = 'cate_deactive';
								} elseif ($data['cstatus'] == 0) { //Deactive Category
									$btn = 1;
									$btnName = 'Activate';
									$action = 'cate_active';
								}
							} elseif ($type == 'post') { //Posts
								$id = $data['pid'];
								if ($data['pstatus'] == 1) { //Active Post
									$btn = 2;
									$btnName = 'Deactivate';
									$action = 'post_deactive';
								} elseif ($data['pstatus'] == 0) { //Deactive Post
									$btn = 1;
									$btnName = 'Activate';
									$action = 'post_active';
								}
							}
							?>

						<tr class="text-muted">
							<td scope="row" class="align-middle">
								<?php echo $i++ . '.'; ?>
							</td>
							<td class="w-5 align-middle">
								<?php 
							if ($type == 'user') {//User Profile
								profilePic($data['upic']);

							} elseif ($type == 'cate') {//Category Name
								echo strtoupper($data['cname']);

							} elseif ($type == 'post') {//Post Image
								if (!empty($data['pimg'])) : //If Post has Image ?>
								<a href="<?php url(); ?>admnPnl/updatePost?post=<?php echo $data['pid']; ?>">
									<img src="<?php echo $data['pimg']; ?>" alt="" class="img-fluid">
								</a>
								<?php endif; ?>
								<?php 
						} ?>
							</td>

							<?php if ($type != 'cate') : //$type is not 'cate' ?>
							<td class="align-middle">
								<a href="<?php url(); ?>admnPnl/updatePost?post=<?php echo $data['pid']; ?>">
									<h5>
										<?php if ($type == 'post') : ?>
										<?php echo ucwords($data['pname']); //Post's Name ?>
										<?php elseif ($type == 'user') : ?>
										<?php echo ucwords($data['ufname']); //User's Name?>
										<?php endif; ?>
									</h5>
								</a>
							</td>

							<td class="align-middle">
								<a href="<?php url(); ?>admnPnl/category">
									<h5 class="text-dark font-weight-bold">
										<?php if ($type == 'post') : ?>
										<?php echo strtoupper($data['cname']); //Post's Category ?>
										<?php elseif ($type == 'user') : ?>
										<?php echo $data['uemail']; //User's Email ?>
										<?php endif; ?>
									</h5>
								</a>
							</td>

							<td class="align-middle">
								<?php if ($type == 'post') : ?>
								<p class="text-muted">
									<?php trimPost($data['pcnt']); //Post's Content ?>
								</p>
								<?php elseif ($type == 'user') : ?>
								<?php echo $data['unum']; //User's Number ?>
								<?php endif; ?>
							</td>
							<?php endif; ?>

							<td class="align-middle">
								<?php if ($type != 'user') : ?>
								<h5 class="text-dark">
									<?php echo ucwords($data['ufname']); //User Name or Create By ?>
								</h5>
								<?php elseif ($type == 'user') : ?>
								<?php showTime($data['last_login']); //User's Last Login ?>
								<?php endif; ?>
							</td>

							<td class="align-middle">
								<?php if ($type == 'post') : ?>
								<?php showCmprTime($data['create_date'], $data['mod_date']); //Creation Date ?>
								<?php elseif ($type == 'user' || $type == 'cate') : ?>
								<?php showTime($data['create_date']); //Creation Date ?>
								<?php endif; ?>
							</td>

							<td class="align-middle">
								<?php if ($btn == 1) : //False Button ?>
								<a href="query?<?php echo $action . '=' . $id; ?>">
									<button class="btn btn-outline-success btn-lg">
										<?php echo $btnName; ?></button>
								</a>
								<?php elseif ($btn == 2) : //True Button ?>
								<a href="query?<?php echo $action . '=' . $id; ?>">
									<button class="btn btn-outline-warning btn-lg">
										<?php echo $btnName; ?></button>
								</a>
								<?php endif; ?>

								<a href="query?<?php echo $actionDelete . '=' . $id; //Delete Button ?>">
									<button class="btn btn-outline-danger btn-lg mt-2 mt-xl-0">Delete</button>
								</a>
							</td>
						</tr>
						<?php

				}
			} else { //No Records Found ?>
						<tr>
							<td colspan="8">
								<h4 class="text-black-50">No
									<?php if ($type == 'user') {
									echo ucfirst($type) . ' User';
								} else {
									echo ucwords($name);
								} ?>
									Found.</h4>
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

//Show Users List Table //*(Normal User)*//
function showUsers($type) //$type = 'users' & 'friends'
{
	$userid = $_SESSION['userid'];
	$userQuery = run("SELECT * FROM user WHERE user.ustatus = '1' AND user.ulevel = '0' AND user.uid != '$userid' ORDER BY user.ufname ASC"); ?>

	<div class="container-fluid bg-dark rounded text-center">
		<div class="row">
			<div class="col-md-12 px-0">
				<h1 class="display-3 py-3 font-weight-bold text-light">
					<?php echo ucwords('all ' . $type); ?>
				</h1>

				<table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
					<thead class="thead-light">
						<tr>
							<th class="w-5">#</th>
							<th>Profile</th>
							<th>Username</th>
							<th colspan="2" class="w-50">Action</th>
						</tr>
					</thead>
					<tbody class="bg-light">
							<?php 
						$i = 1;
						if (countData($userQuery)) {
							foreach ($userQuery as $data) {
								$rid = $data['uid'];

								if ($type == 'users') { //All Users //*(Unrequested Users)*//
									$friendQuery = run("SELECT * FROM friends WHERE rid = '$rid' AND sid= '$userid'");
									foreach ($friendQuery as $fData);

									if (!countData($friendQuery)) { ?>
										<tr>
											<td scope="row" class="align-middle">
												<?php echo $i++ . '.'; ?>
											</td>
											<td class="w-5 align-middle">
												<?php profilePic($data['upic']); ?>
											</td>
											<td class="align-middle">
												<?php echo ucwords($data['ufname']); ?>
											</td>
											<td class="align-middle">
												<form action="">
													<button class="btn btn-outline-info btn-lg" type="submit" name="addFriend" value="<?php echo $data['uid']; ?>">Add Friend</button>
												</form>
											</td>
										</tr>
											<?php

									}

								} elseif ($type == 'friends') { //All Friends //*(Only Requested Users)*//
									$friendQuery = run("SELECT * FROM friends WHERE sid = '$userid' ORDER BY friends.rid ASC");

									foreach ($friendQuery as $fData) {
										if ($fData['rid'] == $data['uid']) { ?>
											<tr>
												<td scope="row" class="align-middle">

													<?php echo $i++ . '.'; ?>
												</td>
												<td class="w-5 align-middle">
													<?php profilePic($data['upic']); ?>
												</td>
												<td class="align-middle">
													<?php echo ucwords($data['ufname']); ?>
												</td>

												<td class="align-middle">
													<?php if ($fData['fstatus'] == 0) : ?>
														<button class="btn btn-outline-info btn-lg">Request Sent</button>
													<?php else : ?>
													<form action="">
														<!-- <a href="query?addfriend="> -->
														<button class="btn btn-outline-primary btn-lg" type="submit" name="addFriend" value="<?php echo $data['uid']; ?>">Message</button>
														<!-- </a> -->
													</form>
													<?php endif; ?>
												</td>
												<td class="align-middle">
													<form action="">
														<button class="btn btn-outline-warning btn-lg" type="submit" name="unfriend" value="<?php echo $data['uid']; ?>">Cancel Request</button>
													</form>
												</td>

											</tr>
															<?php

													}
												}

											}
										}
									} else { ?>
						<tr>
							<td colspan=4>
									<?php 
								if ($type == 'users') {
									redirect('friends');
								} elseif ($type == 'friends') {
									redirect('users');
								} ?>
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

//Count New Records Function //*(Normal User)*//
function newRecords($type) //$type = 'users', 'friends' or 'messages'
{
	$sid = $_SESSION['userid']; //Current User's ID
	$userQuery = run("SELECT * FROM user WHERE create_date >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)"); //One Day Ago Join User Query
	$friendQuery = run("SELECT * FROM friends WHERE fstatus = 0 AND sid = '$sid'"); //New Friends Request Query
	if ($type == 'users') {
		if (countData($userQuery)) { //Check $userQuery found records
			return countData($userQuery); //Return Count of Records
		} else { //Can't Find Any Records in $userQuery 
			return false;
		}
	} elseif ($type == 'friends') {
		if (countData($friendQuery)) {
			return countData($friendQuery);
		} else {
			return false;
		}
	}
	if ($type == 'total') {
		if (countData($userQuery) || countData($friendQuery)) { //Check Found Records in $userQuery or $friendQuery
			$total = (countData($userQuery)) + countData($friendQuery); //Total of Count Records
			if ($total >= 9) { //Check if $total More Than 9
				return "9+"; //Return 9+ as String
			} else {
				return $total; //Return Total of Count Records
			}
		}
	}
}