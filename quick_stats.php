<?php
$worker_names = get_worker_names();
$json_url = 'https://mtgox.com/api/0/data/ticker.php';
$how_many = count($worker_names);


$i = 1;
$current_hashrate = 0;
foreach($worker_names as $value) {
	$current_hashrate += get_current_hashrate($i);
	$i++;
	}
	
	$json_string= CurlGet($json_url);
	$json_data=json_decode($json_string);

	$array = $json_data->ticker;
	$usd = $array->last;
?>

<div id="quick_stats">
<div id="title"><strong>Quick Stats</strong></div>
<div class="name">M. Wrkrs: </div><div class="data"><?php echo $how_many; ?></div>
<div class="name">H. Rate</div><div class="data"><?php echo $current_hashrate; ?> mh/s</div>
<div class="name">Last Mt.Gox USD</div><div class="data"><?php echo $usd; ?></div>
</div>