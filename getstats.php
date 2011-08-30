<?php
include 'config.php';

$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");

$json_url = 'https://arsbitcoin.com/api.php?api_key='.$api_key;
$pool = "ars";
$ch = curl_init( $json_url );

$options = array(
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array('Content-type: application/json'),
CURLOPT_SSL_VERIFYPEER =>false
);

curl_setopt_array( $ch, $options );

$json_string = curl_exec($ch);

$json_data=json_decode($json_string);

//$hashrate_global = $json_data_global->hashrate;

$confirmed_rewards = $json_data->confirmed_rewards;
$user_hashrate = $json_data->hashrate;
$payout_history = $json_data->payout_history;
$total_pps_work = $json_data->totalPPSWork;
$paid_pps_work = $json_data->paidPPSWork;
$pps_donated = $json_data->PPSDonated;
$pps_shares = $json_data->PPSShares;
$stale_shares = $json_data->staleShares;
$workers = (array)$json_data->workers;
$now = date('Y-m-d H:i:s');

$sql = "INSERT INTO `$database`.`personal_stats` (`confirmed_rewards`,`hashrate`,`payout_history`,`total_pps_work`,`paid_pps_work`,`pps_donated`,`pps_shares`,`stale_shares`,`time`) VALUES ('$confirmed_rewards','$user_hashrate','$payout_history','$total_pps_work','$paid_pps_work','$pps_donated','$pps_shares','$stale_shares','$now')";
//echo $sql;
$query = mysql_query($sql);

$array_keys = array_keys($workers);
$i=0;

foreach($workers as $value) {
//echo $array_keys[$i]."<br />";
  $sql = "SELECT * FROM `$database`.`workers` WHERE `name` LIKE '$array_keys[$i]'";
  //echo $sql."<br />";
  $query = mysql_query($sql);
  $exists = @mysql_num_rows($query);
  //var_dump($exists);
  
  if($exists == 0) {
    //echo "INSERT INTO `$database`.`workers` (`id`, `name`) VALUES (null, '$array_keys[$i]');";
    $sql = "INSERT INTO `$database`.`workers` (`id`, `name`, `pool`) VALUES (null, '$array_keys[$i]', '$pool');";
   $query = mysql_query($sql);
    
    echo "Added: ".$array_keys[$i];
    echo "<br>";
  }
  else {
    echo "Worker ".$array_keys[$i]." is already in the database.";
    echo "<br>";
  }
  $i++;
}
echo "<br />";

$count = count($array_keys);
$i = 0;

while ($i < $count) {
	$worker = get_worker($i, $workers);
	${'worker'.$i.'_name'} = $array_keys[$i];
	${'worker'.$i.'_alive'} = $worker[alive];
	${'worker'.$i.'_hashrate'} = $worker[hashrate];
	${'worker'.$i.'_shares'} = $worker[shares];
	${'worker'.$i.'_stale'} = $worker[staleShares];
	${'worker'.$i.'_last_share'} = $worker[timeLastShareCounted];
	${'worker'.$i.'_pps_work'} = $worker[PPSWork];
	${'worker'.$i.'_pps_donated'} = $worker[PPSDonate];
	$i++;
}

$i=0;

while ($i < $count) {
	 $sql = "SELECT `id` FROM `$database`.`workers` WHERE `name` LIKE '${'worker'.$i.'_name'}'";
	 //echo $sql."<br />";
	 $query = mysql_query($sql);
	 $row = mysql_fetch_row($query);
	 //getting previous share / stale data from the database


	//putting new data into the database
	 //echo ${'worker'.$i.'_name'}.' '.$row[0]."<br /><br />";
	 if (${'worker'.$i.'_last_share'} != null) {
	 ${'worker'.$i.'_last_share'} = date('Y-m-d H:i:s', ${'worker'.$i.'_last_share'});
	 }
	 $sql = "INSERT INTO `$database`.`worker_history` (`id`,`alive`,`hashrate`,`shares`,`stale_shares`,`last_share_counted`,`pps_work`,`pps_donate`,`time`) VALUES ( '$row[0]','${'worker'.$i.'_alive'}','${'worker'.$i.'_hashrate'}','${'worker'.$i.'_shares'}','${'worker'.$i.'_stale'}','${'worker'.$i.'_last_share'}','${'worker'.$i.'_pps_work'}','${'worker'.$i.'_pps_donated'}','$now')";
	 $result = mysql_query($sql);
	 $i++;
}

//var_dump($array_keys);

//var_dump($workers);

function get_worker($worker_id, $workers) {
	$array_keys = array_keys($workers);
	$worker_array = (array)$workers[$array_keys[$worker_id]];
	return $worker_array;
}
?>