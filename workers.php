<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include "functions.php";
//$usd = get_mtgox();
$worker_names = get_worker_names();
//var_dump($worker_names);
$how_many = count($worker_names);
$average_hashrate = get_average_hashrate();

$i = 1;
$current_hashrate = 0;
foreach($worker_names as $value) {
	$current_hashrate += get_current_hashrate($i);
	$i++;
	}


?>
<?php include "nav.php"; ?>
<?php include "quick_stats.php"; ?>


<div id="container">

<table id="workers">
<tr><th>Worker Name</th><th>Pool</th><th>Average Hashrate</th><th>Current Hashrate</th><th>Shares</th><th>Stales</th><th>%</th></tr>
<?php
$i = 1;
$total_shares = 0;
$total_stales = 0;
$total_hashrate = 0;
foreach($worker_names as $value) {
$hashrate = get_worker_hashrate($i, "1 DAY");
$current_worker_hashrate = get_current_hashrate($i);
$shares = get_shares($i);
$stales = get_stales($i);
$pool = get_pool($i);
if ($shares != 0) {
	$stale_percent = ($stales / $shares ) *100;
}
else {
	$stale_percent = 0;
}
//$uptime = get_uptime($id);
	echo "<tr class='worker'>";
	echo "<td>".$value."  <a href='purge.php?name=".$value."'>Purge Stats</a></td>";
	echo "<td>".$pool."</td>";
	echo "<td>".number_format($hashrate, 2)."</td>";
	echo "<td>".number_format($current_worker_hashrate, 0)." mh/s</td>";
	echo "<td>".$shares."</td>";
	echo "<td>".$stales."</td>";
	echo "<td>".number_format($stale_percent, 2)."</td>";
	echo "</tr>";
	$i++;
	$total_shares += $shares;
	$total_stales += $stales;
	$total_hashrate += $hashrate;
}
?>
</table>
<div id="notices">*Average Hashrate is a running 24 hour window</div>
</div>
</body>
</html>