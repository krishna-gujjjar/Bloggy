<?php require_once 'include/inc.php';
if (is_ajax()) {//Check Ajax Request
	if (create('action')) {
		if ($_REQUEST['action'] == "signIn") {
			// echo 'Server - ' . $_REQUEST['uname'] . ' ' . $_REQUEST['upass'];
			signIn();
		} elseif ($_REQUEST['action'] == "createPost") {
			if (create('postCnt')) {
				echo 'Content - ' . $_REQUEST['postCnt'];
				if (isset($_FILES['postImg']['name'])) {
					echo ', Image - ' . $_FILES['postImg']['name'];
				}
				if (create('postCate')) {
					echo ', cate - ' . $_REQUEST['postCate'];
				}
				if (create('postCode')) {
					echo ', code - ' . $_REQUEST['postCode'];
				}
			}
		} elseif ($_REQUEST['action'] == "showPosts") {
			posts();
		} elseif ($_REQUEST['action'] == "like" || $_REQUEST['action'] == "unlike") {
			postAction($_REQUEST['action'], $_REQUEST['pid']);
		} elseif ($_REQUEST['action'] == "profile") {
			profile();
		}
	} elseif (create('createPost')) {
		print_r($_FILES);
	}

} else {
	redirect();
}