<?php 
get('var');				//Variables
getAction('index');		//Functions of Dashboard
getAction('user');		//Functions of User's Action
getAction('friend');	//Functions of Friends
getAction('cate');		//Functions of Category
getAction('post');		//Functions of Post


//Checking Container is Create
function create($var)
{
	return isset($_REQUEST[$var]) && !empty($_REQUEST[$var]);
}

//Checking Session is Create
function createSession($var)
{
	return isset($_SESSION[$var]) && !empty($_SESSION[$var]);
}

//Dynamic Title
function title($title = null)
{
	if (is_null($title)) {
		$title = basename($_SERVER['PHP_SELF'], '.php');//Getting File Name
		if ($title == 'index') {
			echo ucwords('home : bloggy');
		} else {
			echo ucwords($title . ' : bloggy');
		}
	} else {
		echo ucwords(basename($_SERVER['PHP_SELF'], '.php'));
	}
}

//Checking Active Page
function active($file)
{
	$title = basename($_SERVER['PHP_SELF'], '.php');
	if ($title == $file) {
		echo ' active';
	}
}

//Get Action's Function Files
function getAction($file)
{
	return require_once 'functions/' . $file . 'Action.function.php';
}

//Show Time
function showTime($time)
{
	$time = strtotime($time);//String to PHP Time
	return print('<span class="text-black-50">' . date('D', $time) . ', <span class="text-dark">' . date('d M', $time) . '</span> ' . date('Y', $time) . ' at <span class="text-dark">' . date('h:i A ', $time) . '</span></span>');
}


//Redirect Javascript
function redirect($location = null)
{
	if (is_null($location)) { //Default Location ?>
		<script>window.location="<?php url(); ?>"</script>
			<?php 
	} elseif ($location == 'back') { //Referer Location
		echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '"</script>';
	} else { //Specific Location ?>
		<script>window.location="<?php url() . print($location); ?>"</script>
			<?php 
	}
}

//Trim Post 95 Charaters
function trimPost($string)
{
	return print(trim(ucfirst(substr($string, 0, 95))) . '...');
}

//Trim Post 200 Characters
function trimLongPost($string)
{
	return print(trim(ucfirst(substr($string, 0, 200))) . '...');
}


//Show Time If Create Time & Modification Time is Change
function showCmprTime($createTime, $modTime)
{
	$createTime = strtotime($createTime);
	$modTime = strtotime($modTime);
	if ($createTime == $modTime) {
		return print('<span class="text-black-50">' . date('D', $createTime) . ', <span class="text-secondary">' . date('d M', $createTime) . '</span> ' . date('Y', $createTime) . ' at <span class="text-secondary">' . date('h:i A ', $createTime) . '</span></span>');
	} else {
		return print('<span class="text-black-50">' . date('D', $modTime) . ', <span class="text-dark">' . date('d M Y', $modTime) . '</span> at <span class="text-dark">' . date('h:i A ', $modTime) . '</span></span>');
	}

}


function showPostTime($time)
{
	date_default_timezone_set('Asia/Kolkata');

	$timeAgo = strtotime($time);
	$timeNow = time();
	$time = $timeNow - $timeAgo;
	$min = round($time / 60);
	$hr = round($time / 3600);
	$day = round($time / 86400);
	$week = round($time / 604800);
	$month = round($time / 2629440);
	$year = round($time / 31553280);


	if ($time <= 60) :
		return "Just Now";


	elseif ($min <= 60) :
		if ($min == 1) :
		return "one minute ago";
	else :
		return "$min minutrs ago";
	endif;


	elseif ($hr <= 24) :
		if ($hr == 1) :
		return "an hour ago";
	else :
		return "$hr hrs ago";
	endif;


	elseif ($day <= 7) :
		if ($min == 1) :
		return "yesterday";
	else :
		return "$day days ago";
	endif;


	elseif ($week <= 4.3) :
		if ($week == 1) :
		return "a week ago";
	else :
		return "$week weeks ago";
	endif;


	elseif ($month <= 12) :
		if ($month == 1) :
		return "a month ago";
	else :
		return "$month months ago";
	endif;


	elseif ($year <= 1) :
		if ($year == 1) :
		return "one year ago";
	else :
		return "$year years ago";
	endif;

	endif;
}

function is_ajax()
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}



//Toggle Modals
function modal($modalID)
{
	echo 'href="javascript:void(0);" data-toggle="modal" data-target="#' . $modalID . '"';
}

//Clean String
function cln($string)
{
	$invalidChar = array("~", "`", "$", "%", "^", "&", "*", "(", ")", "=", "[", "]", "{", "}", "|", "<", ">", ":", "/", "\\", ";", "'", '"');
	return trim(htmlspecialchars(str_replace($invalidChar, "", strtolower($string)), ENT_QUOTES, 'UTF-8'));
}

//Encript String
function encpt($string)
{
	$salt = md5('BlOOggY9#5!&1');
	return hash('sha256', crypt($string, '$$25$$' . $salt . '#$'));
}

//Show Profile Pic
function profilePic($data)
{
	if (!empty($data)) { ?>
		<img src="<?php echo $data; ?>" alt="" class="img-thumbnail">
			<?php 
	} else {
		?>
		<img src="<?php url(); ?>assets/img/user.png" alt="" class="img-thumbnail rounded-circle">
			<?php

	}
}

//Check Login
function checkLogin()
{
	return (createSession('login') && createSession('userid') && createSession('userName') && createSession('userStatus') && createSession('userTime'));
}

//Check Admin
function checkAdmin()
{
	return ($_SESSION['userStatus'] == 1) && ($_SESSION['userLevel'] == 1) && checkLogin();
}


//Run Queries
function run($query)
{
	$connection = mysqli_connect('localhost', 'root', 'root', 'bloggy') or die("Sorry, Can't Connect Bloggy Database Successfully.");
	return mysqli_query($connection, $query);
	mysqli_close($connection);
}


//Count Rows in Database
function countData($data)
{
	if (mysqli_num_rows($data) > 0) {
		return mysqli_num_rows($data);
	} else {
		return false;
	}
}

//Show User List Table
function showTable($type)
{
	if ($type == 'panding') {
		$class = 'warning';
		$id = 0;
		$btn = 1;
		$action = 'active';
	} elseif ($type == 'active') {
		$class = 'success';
		$id = 1;
		$btn = 2;
		$action = 'block';
	} elseif ($type == 'block') {
		$class = 'danger';
		$id = 2;
		$btn = 1;
		$action = 'active';
	} ?>
<div class="container-fluid bg-dark rounded text-center">
	<div class="row">
		<div class="col-md-12 px-0">
			<h1 class="display-4 py-3 font-weight-bold text-<?php echo $class; ?>">
				<?php echo ucwords($type) . ' Users'; ?>
			</h1>

			<table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Profile</th>
						<th>Username</th>
						<th>Email Address</th>
						<th>Mobile Number</th>
						<th>Created Time</th>
						<th>Last Login Time</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="bg-light">
					<?php
				$i = 1;
				$shortUser = run("SELECT * FROM user WHERE ustatus = '$id' AND ulevel = '0' ORDER BY create_date DESC ");
				if (countData($shortUser)) {
					foreach ($shortUser as $data) { ?>
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
							<?php echo $data['uemail']; ?>
						</td>
						<td class="align-middle">
							<?php echo $data['unum']; ?>
						</td>
						<td class="align-middle">
							<?php showTime($data['create_date']); ?>
						</td>
						<td class="align-middle">
							<?php showTime($data['last_login']); ?>
						</td>
						<td class="align-middle">
							<?php if ($btn == 1) { ?>
							<a href="query?<?php echo $action . '=' . $data['uid']; ?>">
								<button class="btn btn-outline-success btn-lg">Active</button>
							</a>
							<?php

					} elseif ($btn == 2) { ?>
							<a href="query?<?php echo $action . '=' . $data['uid']; ?>">
								<button class="btn btn-outline-warning btn-lg">Block</button>
							</a>
							<?php

					} ?>
							<a href="query?delete=<?php echo $data['uid']; ?>">
								<button class="btn btn-outline-danger btn-lg">Delete</button>
							</a>
						</td>
					</tr>
					<?php

			}
		} else { ?>
					<tr>
						<td colspan="8">
							<h4 class="text-black-50">No
								<?php echo ucfirst($type); ?> User Found.</h4>
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





//Show Posts List Table
function showPosts()
{ ?>
<div class="container-fluid bg-dark rounded text-center">
	<div class="row">
		<div class="col-md-12 px-0">
			<h1 class="display-4 py-3 font-weight-bold text-light">
				<div class="row">
					<div class="col-md-8">Posts</div>
					<div class="col-md-4">
						<a href="<?php url(); ?>admnPnl/updatePost" data-toggle="tooltip" data-placement="right" title="Add Post">
							<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</h1>

			<table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Images</th>
						<th>Post Name</th>
						<th>Category</th>
						<th>Post Content</th>
						<th>Create By</th>
						<th>Created Time</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="bg-light">
					<?php
				$i = 1;
				$shortUser = run("SELECT post.*, cate.cid, cate.cname, user.uid, user.ufname FROM post,cate,user WHERE post.cid = cate.cid AND post.uid = user.uid ORDER BY create_date DESC ");
				if (countData($shortUser)) {
					foreach ($shortUser as $data) {
						if ($data['pstatus'] == 1) {
							$action = 'post_deactive';
						} elseif ($data['pstatus'] == 0) {
							$action = 'post_active';
						} ?>
					<tr class="text-secondary">
						<td class="align-middle text-dark">
							<?php echo $i++ . '.'; ?>
						</td>
						<td class="align-middle w-5">
					<?php if (!empty($data['pimg'])) : ?><a href="<?php url(); ?>admnPnl/updatePost?post=<?php echo $data['pid']; ?>"><img src="<?php echo $data['pimg']; ?>" alt="" class="img-fluid"></a><?php endif; ?>
						</td>
						<td class="align-middle">
							<a href="<?php url(); ?>admnPnl/updatePost?post=<?php echo $data['pid']; ?>"><h4><?php echo ucwords($data['pname']); ?></h4></a>
						</td>
						<td class="align-middle">
							<a href="<?php url(); ?>admnPnl/category"><h5 class="text-dark font-weight-bold"><?php echo strtoupper($data['cname']); ?></h5></a>
						</td>
						<td class="align-middle w-25">
							<p><?php trimPost($data['pcnt']); ?></p>
						</td>
						<td class="align-middle">
							<h5 class="text-dark"><?php echo ucwords($data['ufname']); ?></h5>
						</td>
						<td class="align-middle ">
							<?php showCmprTime($data['create_date'], $data['mod_date']); ?>
						</td>
						<td class="align-middle">
							<?php if ($data['pstatus'] == 0) { ?>
							<a href="query?<?php echo $action . '=' . $data['pid']; ?>">
								<button class="btn btn-outline-success btn-lg">Activate</button>
							</a>
							<?php

					} elseif ($data['pstatus'] == 1) { ?>
							<a href="query?<?php echo $action . '=' . $data['pid']; ?>">
								<button class="btn btn-outline-warning btn-lg">Deactive</button>
							</a>
							<?php

					} ?>
							<a href="query?post_delete=<?php echo $data['pid']; ?>">
								<button class="btn btn-outline-danger btn-lg">Delete</button>
							</a>
						</td>
					</tr>
					<?php

			}
		} else { ?>
					<tr>
						<td colspan="8">
							<h4 class="text-black-50">No Posts Found.</h4>
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

function updatePost()
{
	if (create('pname') || create('pcnt') || create('pcate')) {
		echo $_REQUEST['pname'];
		echo $_REQUEST['pcnt'];
		echo $_REQUEST['pcate'];
		echo $_FILES['pimg']['tmp_name'];
		if (file_exists($_FILES['pimg']['tmp_name'])) {
			//IF Upload File
		}

		//Insert Black ImagePath


	} else {
		redirect('back');
	}

}

//Show Single Post For Update
function showUpdatePost($id)
{
	$showPost = run("SELECT * FROM post WHERE pid = '$id' AND pstatus = '1'");
	if (countData($showPost)) : ?>
		<?php foreach ($showPost as $data); ?>
		<form action="query" class="card shadow" method="post" enctype="multipart/form-data">
			<div class="card-header">
				<h1>Edit Post</h1>
			</div>
			<div class="card-body px-5 py-3">
				<div class="form-group">
					<label for="pname">Post Title :</label>
					<input type="text" class="form-control form-control-lg" name="pname" id="pname" placeholder="Post Title" value="<?php echo ucwords($data['pname']); ?>">
				</div>
				<div class="form-group">
					<label for="pcnt">Post Content :</label>
					<textarea class="form-control form-control-lg" name="pcnt" id="pcnt" rows=2><?php echo ucfirst($data['pcnt']) ?></textarea>
				</div>
				<div class="form-group row">

					<?php if (!empty($data['pimg'])) : ?>
						<div class="form-group col-sm-4">
							<img src="<?php echo $data['pimg']; ?>" alt="" class="img-thumbnail">
						</div>
					<?php endif; ?>

					<div class="form-group col-sm-4">
						<div class="form-group">
							<label for="pcate">Category :</label>
							<select class="custom-select" name="pcate" id="pcate">
								<option hidden>----------- Select Category -----------</option>
								<?php $cid = $data['cid']; ?>
									<?php $showCate = run("SELECT * FROM cate WHERE cstatus = '1'"); ?>
									<?php foreach ($showCate as $val) : ?>
										<option value="<?php echo $val['cid']; ?>" <?php if ($cid == $val['cid']) {
																																																					echo 'selected';
																																																				} ?>>
											<?php echo strtoupper($val['cname']); ?>
										</option>
									<?php endforeach; ?>
							</select>
						</div>
						<hr>

						<div class="form-group row text-center">
							<div class=" col-sm-6">
								<span class="">Upload Image :</span>
								<label class="custom-file mt-4">
									<input type="file" name="pimg" id="pimg" class="custom-file-input d-none">
									<span class="custom-file-control btn btn-lg btn-outline-info">Upload <i class="ml-1 fas fa-edit fa-lg"></i></span>
								</label></div>
							<a href="query?pimgDelete=" class=" col-sm-6 mt-5">
								<button class="btn btn-lg btn-outline-danger">Delete
									<i class="fa fa-trash ml-1" aria-hidden="true"></i>
								</button>
							</a>
						</div>
					</div>

				</div>

				<div class="form-group">
					<button type="submit" class="form-control btn btn-outline-success" name="post_update" value="update">Update</button>
				</div>

			</div>
		</form>
	<?php else : ?>
		<?php redirect('back'); ?>
	<?php endif; ?>
	<?php

}

//Show Category List Table
function showCate()
{ ?>
<div class="container-fluid bg-dark rounded text-center">
	<div class="row">
		<div class="col-md-12 px-0">
			<h1 class="display-4 py-3 font-weight-bold text-light">
				<div class="row">
					<div class="col-md-8">Categories</div>
					<div class="col-md-4">
						<a <?php modal('cate'); ?> data-toggle="tooltip" data-placement="right" title="Add Category"><i class="fa fa-plus-circle text-success" aria-hidden="true"></i></a>
					</div>
				</div>
			</h1>

			<table class="table rounded table-bordered table-hover table-responsive-sm mb-0">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Category Name</th>
						<th>Create By</th>
						<th>Created Time</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="bg-light">
					<?php
				$i = 1;
				$shortUser = run("SELECT cate.*, user.uid, user.ufname FROM cate LEFT JOIN user ON cate.uid = user.uid ORDER BY create_date DESC");
				if (countData($shortUser)) {
					foreach ($shortUser as $data) {
						if ($data['cstatus'] == 1) {
							$action = 'cate_deactive';
						} elseif ($data['cstatus'] == 0) {
							$action = 'cate_active';
						} ?>
					<tr>
						<td scope="row" class="align-middle">
							<?php echo $i++ . '.'; ?>
						</td>
						<td class="align-middle">
							<?php echo strtoupper($data['cname']); ?>
						</td>
						<td class="align-middle">
							<?php echo ucwords($data['ufname']); ?>
						</td>
						<td class="align-middle">
							<?php showTime($data['create_date']); ?>
						</td>
						<td class="align-middle">
							<?php if ($data['cstatus'] == 0) { ?>
							<a href="query?<?php echo $action . '=' . $data['cid']; ?>">
								<button class="btn btn-outline-success btn-lg">Activate</button>
							</a>
							<?php

					} elseif ($data['cstatus'] == 1) { ?>
							<a href="query?<?php echo $action . '=' . $data['cid']; ?>">
								<button class="btn btn-outline-warning btn-lg">Deactive</button>
							</a>
							<?php

					} ?>
							<a href="query?cate_delete=<?php echo $data['cid']; ?>">
								<button class="btn btn-outline-danger btn-lg">Delete</button>
							</a>
						</td>
					</tr>
					<?php

			}
		} else { ?>
					<tr>
						<td colspan="8">
							<h4 class="text-black-50">No Categories Found.</h4>
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


//Add New Category
function addCate()
{
	if (create('cate')) {
		if (create('cname')) {
			$cname = cln($_REQUEST['cname']);
			$checkQuery = run("SELECT * FROM cate WHERE cname = '$cname'");
			if (!countData($checkQuery)) {
				$id = $_SESSION['userid'];
				$query = run("INSERT INTO cate(cname,uid,cstatus)VALUES('$cname','$id','1')");
				if ($query) {
					notify(strtoupper($cname) . ' added Successfully.', 'success'); ?>
					<script>
						setTimeout("location.href = '<?php url(); ?>admnPnl/category'", 1500)
					</script>
						<?php

				} else {
					notify('Something went wrong', 'warning'); ?>
						<script>
							setTimeout("location.href = '<?php url(); ?>admnPnl/category'", 1500)
						</script>
						<?php

				}
			} else {
				notify(strtoupper($cname) . ' Already Exists.', 'warning'); ?>
				<script>
					setTimeout("location.href = '<?php url(); ?>admnPnl/category'", 1500)
				</script>
				<?php

		}
	} else {
		notify('Please Fill Category Name', 'error'); ?>
			<script>
				setTimeout("location.href = '<?php url(); ?>admnPnl/category'", 1500)
			</script>
				<?php

		}
	}
}


//Category Action
function cateAction()
{
	if (create('cate_active')) {
		$id = $_REQUEST['cate_active'];
		$query = run("UPDATE cate SET cstatus='1' WHERE cid='$id'");
		if ($query) {
			redirect('back');
		} else {
			notify('Something went wrong', 'warning');
		}

	} elseif (create('cate_deactive')) {
		$id = $_REQUEST['cate_deactive'];
		$query = run("UPDATE cate SET cstatus='0' WHERE cid='$id'");
		if ($query) {
			redirect('back');
		} else {
			notify('Something went wrong', 'warning');
		}

	} elseif (create('cate_delete')) {
		$id = $_REQUEST['cate_delete'];
		$query = run("DELETE FROM cate WHERE cid='$id'");
		if ($query) {
			redirect('back');
		} else {
			notify('Something went wrong', 'warning');
		}
	}
}


//Welcome Message
function welcome()
{
	$userName = $_SESSION['userName'];
	$uid = $_SESSION['userid'];
	$time = time() - strtotime($_SESSION['userTime']);
	if (round($time / 3600) >= 24) {
		$time = date('y-m-d h:i:s', time());
		$updateTime = run("UPDATE user SET last_login='$time' WHERE uid= '$uid'");
		if ($updateTime) {
			echo "<script>
					const toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 1500
					});
					toast({
					type: 'success',
					title: 'Welcome " . $userName . ", Glad to see you again !'
					})
				</script>";
			$_SESSION['userTime'] = date('Y-m-d H:i:s', time());
		}
	}
}

//Notification
function notify($title, $type, $msg = null)
{
	$redirect = basename($_SERVER['PHP_SELF'], '.php');
	if ($msg == null) {
		echo "<script>
				swal({
					position: 'top-end',
					title: '" . $title . "',
					type: '" . $type . "',
					showConfirmButton: false,
					timer: 1500})
			</script>";
		?>
			<!-- <script>//setTimeout("location.href = '<?php echo $redirect; ?>'",1500)</script> -->
			<?php

	} else {
		echo "<script>
				swal({
					position: 'top-end',
					title: '" . $title . "',
					text: '" . $msg . "',
					type: '" . $type . "',
					showConfirmButton: false,
					timer: 1500})
			</script>";
		?>
			<!-- <script>//setTimeout("location.href = '<?php echo $redirect; ?>'",1500)</script> -->
			<?php

	}
}



//HightLight Code
function highlightText($text)
{
	$text = trim($text);
	$text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
	$text = trim($text);
	$text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
	$text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
	$text = trim($text);  // remove line breaks
	$text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
	$text = trim($text);  // remove line breaks
	$text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

	return $text;
}


function highlightTextExt($text, $fileExt = "")
{
	if ($fileExt == "php") {
		ini_set("highlight.comment", "#008000");
		ini_set("highlight.default", "#000000");
		ini_set("highlight.html", "#808080");
		ini_set("highlight.keyword", "#0000BB; font-weight: bold");
		ini_set("highlight.string", "#DD0000");
	} else if ($fileExt == "html") {
		ini_set("highlight.comment", "green");
		ini_set("highlight.default", "#CC0000");
		ini_set("highlight.html", "#000000");
		ini_set("highlight.keyword", "black; font-weight: bold");
		ini_set("highlight.string", "#0000FF");
	}
// ...

	$text = trim($text);
	$text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
	$text = trim($text);
	$text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
	$text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
	$text = trim($text);  // remove line breaks
	$text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
	$text = trim($text);  // remove line breaks
	$text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

	return $text;
}
?>