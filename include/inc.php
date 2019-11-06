<?php
get('function'); //Get Function

//Getting Files Function
function get($file)
{
	if (strpos($_SERVER['PHP_SELF'], 'admnPnl') || strpos($_SERVER['PHP_SELF'], 'assets') || strpos($_SERVER['PHP_SELF'], 'vendor')) {
		require_once '../include/' . $file . '.inc.php';
	} elseif (strpos($_SERVER['PHP_SELF'], 'include')) {
		require_once $file . '.inc.php';
	} else {
		require_once 'include/' . $file . '.inc.php';
	}
}
?>