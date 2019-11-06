<?php

function inFriend()
{
	$user = $_SESSION['userid'];
	$friendQuery = run("SELECT * FROM friends WHERE sid='$user'");
	if (countData($friendQuery)) {
		return $friendQuery;
	} else {
		return false;
	}
}


//Add Friends Function
function addFriend()
{
	if (create('addFriend')) {
		$send = cln($_SESSION['userid']);
		$receive = cln($_REQUEST['addFriend']);
		$addQuery = run("INSERT INTO friends(sid,rid)VALUES('$send','$receive')");
		if ($addQuery) {
			notify('Request Sent Successfully', 'success');
		} else {
			notify('Something went wrong', 'error');
		}
	} elseif (create('unfriend')) {
		$send = cln($_SESSION['userid']);
		$receive = cln($_REQUEST['unfriend']);
		$unfriendQuery = run("DELETE FROM friends WHERE sid='$send' AND rid='$receive'");
		if ($unfriendQuery) {
			notify('Unfriend Successfully', 'success');
		} else {
			notify('Something went wrong', 'error');
		}
	} // elseif ($type == 'blockFriend') {

	// }
}

