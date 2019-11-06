<?php
//User Action's Function
function userAction()
{
	if (create('active')) { //Activating User
		$id = $_REQUEST['active'];
		$query = run("UPDATE user SET ustatus='1' WHERE uid='$id'");
		if ($query) :
			redirect('back');
		else :
			notify('Something went wrong', 'warning');
		endif;
	} elseif (create('block')) { //Blocking User
		$id = $_REQUEST['block'];
		$query = run("UPDATE user SET ustatus='2' WHERE uid='$id'");
		if ($query) :
			redirect('back');
		else :
			notify('Something went wrong', 'warning');
		endif;
	} elseif (create('delete')) { //Deleting User
		$id = $_REQUEST['delete'];
		$query = run("DELETE FROM user WHERE uid='$id'");
		if ($query) :
			redirect('back');
		else :
			notify('Something went wrong', 'warning');
		endif;
	}
}


//Checking User's Profile is Update or not
function checkProfile()
{
	if (checkLogin()) { //Checking User Loged In
		$uid = $_SESSION['userid'];
		$checkProfile = run("SELECT * FROM user WHERE uid = '$uid'"); //Show Result From 'uid'
		if (countData($checkProfile)) {
			$data = mysqli_fetch_assoc($checkProfile); //Fetching Result From Database
			if (empty($data['upic']) && empty($data['unum'])) { //If 'upic' & 'unum' are empty
				?>
				<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>
						<span class="lead font-weight-bold">Hey
							<?php echo $_SESSION['userName']; ?>
						</span>, Please Update Your Profile First... &nbsp;
						<a class="text-warning" href="<?php url(); ?>profile/">Click Here</a>
					</strong>
				</div>
		<?php

					}
				}
			}
		}

		//Create New User's Function
		function signUp()
		{
			if (create('signup')) {
				if (create('ufname') && create('ulname') && create('uemail') && create('upass')) {
					if (filter_var($_REQUEST['uemail'], FILTER_VALIDATE_EMAIL)) { //Valid Email
						$uemail = cln($_REQUEST['uemail']);
						$checkQuery = run("SELECT * FROM user WHERE uemail = '$uemail'"); //Email already Exists.
						if (!countData($checkQuery)) {
							$ufname = cln($_REQUEST['ufname']) . ' ' . cln($_REQUEST['ulname']);
							$uname = cln($_REQUEST['uemail']);
							$upass = encpt($_REQUEST['upass']);
							$query = run("INSERT INTO user(ufname,uname,uemail,upass)VALUES('$ufname','$uname','$uemail','$upass')"); //Creating New User's Query
							if ($query) {
								notify(ucwords($ufname) . ', Your Account Successfully Created', 'success');
							} else {
								notify('Opps... Something went wrong', 'warning');
							}
						} else {
							notify($uemail . ' Already Exists.', 'error');
						}
					} else {
						notify('Please Input Valid Email Address', 'error');
					}
				} else {
					notify('Oops...,', 'warning', 'Empty Fileds, Please Fill Properly');
				}
			}
		}


		//Check User's Sign In
		function signIn()
		{

			/*// if (create('signin')) {
				if (create('uname') && create('upass')) {
					$uname = encpt(cln($_REQUEST['uname']));
					$pass = encpt($_REQUEST['upass']);
					$query = run("SELECT * FROM user WHERE uname = '$uname' AND upass = '$pass'"); //Check user's Login Details
					if (countData($query)) {
						foreach ($query as $data) {
							$_SESSION['userid'] = $data['uid'];
							$_SESSION['userName'] = ucwords($data['ufname']);
							$_SESSION['userStatus'] = $data['ustatus'];
							$_SESSION['userLevel'] = $data['ulevel'];
							$_SESSION['userTime'] = $data['last_login'];
							$_SESSION['login'] = md5(rand(11111, 9999999));
						}

						if ($data['ulevel'] == 1 && $data['ustatus'] == 1) { //Admin
							notify(ucwords('welcome back admin'), 'success');
							redirect('admnPnl/');
						} elseif ($data['ulevel'] == 0) { //Users
							if ($data['ustatus'] == 1) { //Active user

								// notify('Login Successfull', 'success');
								notify(ucwords('welcome ' . $data['ufname']), 'success');
							} elseif ($data['ustatus'] == 0) { //Pending user

								notify(ucwords(ucwords($data['ufname']) . ', Your Account is Pending', 'warning', 'Please Try After Some Time'), 'warning');
								session_destroy();
							} elseif ($data['ustatus'] == 2) { //Block user
								notify(ucwords('Sorry ' . $data['ufname'] . ', Your Account is Block', 'error', 'Please Contact To Admin, Than Try Again'), 'error');
								session_destroy();
							}
						}
					} else {
						notify('Invalid Login Deatails', 'warning');
					}
				}*/



			// if (create('signin')) {
			if (create('uname') && create('upass')) {
				$uname = cln($_REQUEST['uname']);
				$pass = $_REQUEST['upass'];
				$query = run("SELECT * FROM user WHERE uname = '$uname'"); //Check user's Login Details
				if (countData($query)) {

					foreach ($query as $data) {
						$_SESSION['userid'] = $data['uid'];
						$_SESSION['userName'] = ucwords($data['ufname']);
						$_SESSION['userStatus'] = $data['ustatus'];
						$_SESSION['userLevel'] = $data['ulevel'];
						$_SESSION['userTime'] = $data['last_login'];
						$_SESSION['login'] = md5(rand(11111, 9999999));
						$PassworD = $data['upass'];
					}
					if (password_verify($pass, $PassworD)) {
						if ($data['ulevel'] == 1 && $data['ustatus'] == 1) { //Admin
							notify(ucwords('welcome back admin'), 'success');
							redirect('admnPnl/');
						} elseif ($data['ulevel'] == 0) { //Users
							if ($data['ustatus'] == 1) { //Active user

								// notify('Login Successfull', 'success');
								notify(ucwords('welcome ' . $data['ufname']), 'success');
							} elseif ($data['ustatus'] == 0) { //Pending user

								notify('Oops! ' . $_SESSION['userName'] . ',<br> Your Account is Pending <br> Please Try After Some Time', 'warning');
								session_destroy();
							} elseif ($data['ustatus'] == 2) { //Block user
								notify('Sorry ' . $_SESSION['userName'] . ', <br>Your Account is Block, <br>Please Contact To Admin, Than Try Again', 'error');
								session_destroy();
							}
						}
					} else {
						notify('Invalid Login Deatails', 'warning');
					}
				}
			}  // else {
			// 	notify('Please All Feileds', 'error');
			// 	print('Please fill all feileds');
			// 	return false;
			// }
			// }
		}


		//Logout from current account
		function logout()
		{
			if (isset($_REQUEST['logout']) && checkLogin()) {
				session_destroy();
				notify('Logout Successfull', 'success'); //Show Messge
				?>
		<script>
			setTimeout("location.href = '<?php url(); ?>'", 1500);
		</script>
	<?php
		}
	}

	//Profile
	function profile()
	{
		$uid = $_SESSION['userid'];
		$query = run("SELECT * FROM user INNER JOIN post ON post.uid=user.uid WHERE user.uid='$uid '");
		if (countData($query)) {

			?>
		<h1>

	<?php
			foreach ($query as $data) {
				echo $data['ufname'] . $data['pname'];
			}
		} else { }
	}
