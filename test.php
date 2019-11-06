<?php 
define('host', 'localhost');
define('userName', 'root');
define('userPass', 'root');
define('db', 'learn');
$connnectionNew = mysqli_connect(host, userName, userPass, db) or die('Cant Connect Server');
?>
<form action="" method="get">
	<input type="radio" name="cw" value="work">Work
	<input type="radio" name="cw" value="study">Study
	<input type="text" placeholder="School" name="clg">
	<input type="text" placeholder="Course" name="crs">
	<button name="sv" type="submit">Save</button>
</form>
<?php
if (isset($_REQUEST['sv']) && isset($_REQUEST['cw']) && isset($_REQUEST['clg']) && isset($_REQUEST['crs'])) {
	echo 'Working';
	echo $_REQUEST['crs'] . '<br>';
	echo $_REQUEST['clg'] . '<br>';
	echo $_REQUEST['cw'] . '<br>';
	$dataArr = array(
		'type' => $_REQUEST['cw'],
		'location' => $_REQUEST['clg'],
		'kind' => $_REQUEST['crs']
	);
	$dataJSON = json_encode($dataArr);
	$querry = mysqli_query($connnectionNew, "INSERT INTO test(plike)VALUES('$dataJSON')");


	if ($querry) {
		echo 'Connect';
	}
	?>

<pre>
	<?php print_r($dataJSON); ?>
	<hr>
	<br>
	<hr>
	<?php print_r(json_decode($dataJSON, true)); ?>
</pre>
<?php

}

$querryFetch = mysqli_query($connnectionNew, "SELECT * FROM test WHERE pid = 4");
// $variable = mysqli_fetch_assoc($querryFetch);
// $daJ=json_decode($variable,true);
foreach ($querryFetch as $value) {
	$nwnn = $value['plike'];
	$sda = json_decode($nwnn, true);
	echo $sda['location'];
}
?>	