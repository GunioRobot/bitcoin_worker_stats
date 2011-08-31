<?php
include "config.php";

function make_pair($time, $data) {
		return array($time, $data);
}


function CurlGet($url)
   {
         $opts = array(
          'http'=>array(
            'timeout'=> 3, // 3 second timeout
            'user_agent'=> 'hashcash',
            'header'=>"Accept-language: en\r\n"
          )
        );
        $context = stream_context_create($opts);
        $output = file_get_contents($url, FALSE, $context);
        return $output;
     }
	 
function get_times() {
	$now = date('H', time());
	$_24 = date('H', time() - (24*60*60));
	$_23 = date('H', time() - (23*60*60));
	$_22 = date('H', time() - (22*60*60));
	$_21 = date('H', time() - (21*60*60));
	$_20 = date('H', time() - (20*60*60));
	$_19 = date('H', time() - (19*60*60));
	$_18 = date('H', time() - (18*60*60));
	$_17 = date('H', time() - (17*60*60));
	$_16 = date('H', time() - (16*60*60));
	$_15 = date('H', time() - (15*60*60));
	$_14 = date('H', time() - (14*60*60));
	$_13 = date('H', time() - (13*60*60));
	$_12 = date('H', time() - (12*60*60));
	$_11 = date('H', time() - (11*60*60));
	$_10 = date('H', time() - (10*60*60));
	$_9 = date('H', time() - (9*60*60));
	$_8 = date('H', time() - (8*60*60));
	$_7 = date('H', time() - (7*60*60));
	$_6 = date('H', time() - (6*60*60));
	$_5 = date('H', time() - (5*60*60));
	$_4 = date('H', time() - (4*60*60));
	$_3 = date('H', time() - (3*60*60));
	$_2 = date('H', time() - (2*60*60));
	$_1 = date('H', time() - (1*60*60));
	
	$times = $_24.','.$_23.','.$_22.','.$_21.','.$_20.','.$_19.','.$_18.','.$_17.','.$_16.','.$_15.','.$_14.','.$_13.','.$_12.','.$_11.','.$_10.','.$_9.','.$_8.','.$_7.','.$_6.','.$_5.','.$_4.','.$_3.','.$_2.','.$_1.','.$now;
	return $times;
}

function get_worker_24h($id) {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	$hours = array(
		0 => date('Y-m-d H', time()).":00:00",
		1 => date('Y-m-d H', time() - (1*60*60)).":00:00",
		2 => date('Y-m-d H', time() - (2*60*60)).":00:00",
		3 => date('Y-m-d H', time() - (3*60*60)).":00:00",
		4 => date('Y-m-d H', time() - (4*60*60)).":00:00",
		5 => date('Y-m-d H', time() - (5*60*60)).":00:00",
		6 => date('Y-m-d H', time() - (6*60*60)).":00:00",
		7 => date('Y-m-d H', time() - (7*60*60)).":00:00",
		8 => date('Y-m-d H', time() - (8*60*60)).":00:00",
		9 => date('Y-m-d H', time() - (9*60*60)).":00:00",
		10 => date('Y-m-d H', time() - (10*60*60)).":00:00",
		11 => date('Y-m-d H', time() - (11*60*60)).":00:00",
		12 => date('Y-m-d H', time() - (12*60*60)).":00:00",
		13 => date('Y-m-d H', time() - (13*60*60)).":00:00",
		14 => date('Y-m-d H', time() - (14*60*60)).":00:00",
		15 => date('Y-m-d H', time() - (15*60*60)).":00:00",
		16 => date('Y-m-d H', time() - (16*60*60)).":00:00",
		17 => date('Y-m-d H', time() - (17*60*60)).":00:00",
		18 => date('Y-m-d H', time() - (18*60*60)).":00:00",
		19 => date('Y-m-d H', time() - (19*60*60)).":00:00",
		20 => date('Y-m-d H', time() - (20*60*60)).":00:00",
		21 => date('Y-m-d H', time() - (21*60*60)).":00:00",
		22 => date('Y-m-d H', time() - (22*60*60)).":00:00",
		23 => date('Y-m-d H', time() - (23*60*60)).":00:00",
		24 => date('Y-m-d H', time() - (24*60*60)).":00:00"
	);
	$hours = array_reverse($hours);
	$data = '';
	foreach ($hours as $value)
	{
		$sql = "SELECT hashrate FROM `$database`.`worker_history` WHERE ID = $id AND  time <= '$value' ORDER BY time DESC LIMIT 0,1";
	//echo "Query: ".$sql."<br />";
		$result = mysql_query($sql, $db);
		$row = mysql_fetch_row($result);
		$data = $data.','.$row[0];
	}
	$data = trim($data,',');
	return $data;
}

function get_worker_uptime($id) {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	$hours = array(
		0 => date('Y-m-d H', time()).":00:00",
		1 => date('Y-m-d H', time() - (1*60*60)).":00:00",
		2 => date('Y-m-d H', time() - (2*60*60)).":00:00",
		3 => date('Y-m-d H', time() - (3*60*60)).":00:00",
		4 => date('Y-m-d H', time() - (4*60*60)).":00:00",
		5 => date('Y-m-d H', time() - (5*60*60)).":00:00",
		6 => date('Y-m-d H', time() - (6*60*60)).":00:00",
		7 => date('Y-m-d H', time() - (7*60*60)).":00:00",
		8 => date('Y-m-d H', time() - (8*60*60)).":00:00",
		9 => date('Y-m-d H', time() - (9*60*60)).":00:00",
		10 => date('Y-m-d H', time() - (10*60*60)).":00:00",
		11 => date('Y-m-d H', time() - (11*60*60)).":00:00",
		12 => date('Y-m-d H', time() - (12*60*60)).":00:00",
		13 => date('Y-m-d H', time() - (13*60*60)).":00:00",
		14 => date('Y-m-d H', time() - (14*60*60)).":00:00",
		15 => date('Y-m-d H', time() - (15*60*60)).":00:00",
		16 => date('Y-m-d H', time() - (16*60*60)).":00:00",
		17 => date('Y-m-d H', time() - (17*60*60)).":00:00",
		18 => date('Y-m-d H', time() - (18*60*60)).":00:00",
		19 => date('Y-m-d H', time() - (19*60*60)).":00:00",
		20 => date('Y-m-d H', time() - (20*60*60)).":00:00",
		21 => date('Y-m-d H', time() - (21*60*60)).":00:00",
		22 => date('Y-m-d H', time() - (22*60*60)).":00:00",
		23 => date('Y-m-d H', time() - (23*60*60)).":00:00",
		24 => date('Y-m-d H', time() - (24*60*60)).":00:00"
	);
	$hours = array_reverse($hours);
	$data = '';
	$worker_names = get_worker_names();
	$count = count($worker_names);
	foreach ($hours as $value)
	{
		$sql = "SELECT alive FROM `$database`.`worker_history` WHERE ID = $id AND  time <= '$value' ORDER BY time DESC LIMIT 0,1";
	//echo "Query: ".$sql."<br />";
		$result = mysql_query($sql, $db);
		$row = mysql_fetch_row($result);
		$data = $data.','.(($row[0] / $count) *100);
	}
	$data = trim($data,',');
	return $data;
}

function get_worker_1h($id) {
	include "config.php";
	date_default_timezone_set('America/Chicago');
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$sql = "SELECT * FROM `$database`.`worker_history` WHERE ID = $id AND  time >= (SYSDATE() - INTERVAL 1 HOUR)";
	//echo $sql;
	$result = mysql_query($sql, $db);
	
	if ($result != null) {
	while ($row = mysql_fetch_array($result)) {
		$time_raw[] = (date(strtotime($row['time'])) -18000)*1000;
		$hashrate_raw[] = (double)$row['hashrate'];
	}
		if ($time_raw != null) {
		$time = array_reverse($time_raw);
		}
		if ($hashrate_raw != null) {
		$hashrate = array_reverse($hashrate_raw);}
		if ($hashrate && $time) {
		$data = array_map(make_pair, $time, $hashrate);
		$data_encoded = json_encode($data);
		}
		//var_dump($data);
		//var_dump($data_encoded);
		}
		else { $data_encoded = null;}
		return $data_encoded;
}
function get_workers($i = null) {
include "config.php";
if ($i == null) {
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$i = 0;
	//get worker names
	$sql = "SELECT * FROM `$database`.`workers`";
	//echo $sql."<br />";
	$result = mysql_query($sql, $db);
	//var_dump($result);
	
	$count = 0;
	while($row = mysql_fetch_array($result)) {
		${'worker'.$i.'name'} = $row['name'];
		${'worker'.$i.'_id'} = $row['id'];
		$i++;
		$count++;
	}
	
	//get worker history
	$i=0;
	//if ($start == null) {
	$sql = "SELECT * FROM `$database`.`worker_history`";
	//}
	//else {
	//$sql = "SELECT * FROM `$database`.`worker_history` WHERE `time` > '$start'";
	//}
	
	$result = mysql_query($sql, $db);
	//var_dump($result);
	while($row = mysql_fetch_array($result)) {
	$id = $row['id'] -1;
	//echo "<br />".${'worker'.$id.'name'}.": ".$row['shares']." ID: ".$id."<br />";
		
		${'worker'.$id.'_shares_raw'}[] = (double)$row['shares'];
		${'worker'.$id.'_stales_raw'}[] = (double)$row['stale_shares'];
		${'worker'.$id.'_hashrate_raw'}[] = (double)$row['hashrate'];
		${'worker'.$id.'_time_raw'}[] = strtotime($row['time']);
	}
	//var_dump(${'worker0_shares_raw'});
	$i = 0;
	$data;
	
	while ($i < $count) {
		//echo "<br /><br />".${'worker'.$i.'name'}. ": ";
		//var_dump(${'worker'.$i.'_shares_raw'});
		${'worker'.$i.'_shares'}= array_reverse(${'worker'.$i.'_shares_raw'});
		//echo "Reversed shares array: ";
		//var_dump(${'worker'.$i.'_shares'});
		${'worker'.$i.'_stales'} = array_reverse(${'worker'.$i.'_stales_raw'});
		${'worker'.$i.'_hashrate'} = array_reverse(${'worker'.$i.'_hashrate_raw'});
		${'worker'.$i.'_time'} = array_reverse(${'worker'.$i.'_time_raw'});
		
		${'worker'.$i} = array( 'shares'=>${'worker'.$i.'_shares'}, 'stales' => ${'worker'.$i.'_stales'}, 'hashrate' =>${'worker'.$i.'_hashrate'}, 'time'=>${'worker'.$i.'_time'});
		//var_dump(${'worker'.$i});
		$data[${'worker'.$i.'name'}] = ${'worker'.$i};
		$i++;
	}
	
	$i = 0;
	mysql_close();
	
	//$data = 0;
	}
	return $data;
}

function get_worker_names() {
include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$i = 0;
	//get worker names
	$sql = "SELECT * FROM `$database`.`workers`";
	//echo $sql."<br />";
	$result = mysql_query($sql, $db);
	//var_dump($result);
	
	$count = 0;
	while ($row = mysql_fetch_array($result))
	{
		$position = strpos($row['name'], '.') +1;
		//echo $position."<br />";
		$substring = substr($row['name'], $position);
		$data[$i] = $substring;
		$i++;
	}
	//var_dump($data);
	mysql_close();
	return $data;
}
function get_worker_hashrate($id, $interval = "1 DAY") {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$sql = "SELECT hashrate FROM `$database`.`worker_history` WHERE ID = $id AND  time >= (SYSDATE() - INTERVAL $interval)";
	//echo $sql;
	$result = mysql_query($sql, $db);
	$sum = 0;
	$count = 0;
	while ($row = mysql_fetch_array($result))
	{
	//var_dump( $row);
		$count ++;
		$sum += $row['hashrate'];
	}
	if ($sum != 0) {
	$average = $sum / $count;
	}
	else
	{
		$average = 0;
		}
	return $average;
}
function get_average_hashrate() {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$sql = "SELECT hashrate FROM `$database`.`worker_history`";
	//echo $sql;
	$result = mysql_query($sql, $db);
	$count=0;
	$average=0;
	while($row = mysql_fetch_array($result)) {
		$average += $row[0];
		//echo "Row: ".$row."<br />";
		$count++;
		//echo "Count: ".$count."<br />Average: ".$average."<br />";
	}
	$data = ( $average / $count);
	return $data;
}

function get_current_hashrate($id) {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	//echo "ID: ".$id."<br />";
	$sql = "SELECT hashrate FROM `$database`.`worker_history` WHERE id = $id ORDER BY time DESC LIMIT 0,1";
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$data = $row[0];
	//echo "Hashrate: ".$data."<br />";
	return $data;
}

function get_pool($id) {

	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$i = 0;
	//get worker names
	$sql = "SELECT * FROM `$database`.`workers` WHERE id = $id";
	//echo $sql."<br />";
	$result = mysql_query($sql, $db);
	//var_dump($result);
	
	$count = 0;
	while ($row = mysql_fetch_array($result))
	{
		//echo $position."<br />";
		$data=$row['pool'];
		$i++;
	}
	//var_dump($data);
	mysql_close();
	return $data;
}

function get_shares($id) {
include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$sql = "SELECT shares FROM `$database`.`worker_history` WHERE ID = $id ORDER BY time DESC LIMIT 0,1";
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$data = $row[0];
	return $data;
}
function get_stales($id) {
include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	
	$sql = "SELECT stale_shares FROM `$database`.`worker_history` WHERE ID = $id ORDER BY ID DESC LIMIT 0,1";
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$data = $row[0];
	return $data;
}
function get_uptime($id) {

}
function purge_stats($name) {
	include "config.php";
	$db = mysql_connect($host,$dbuser,$dbpassword) or die("Failed to connect to database");
	$sql = "SELECT * FROM `$database`.`workers` WHERE name LIKE '%$name'";
	//echo $sql;
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$id = $row[0];
	
	$sql = "DELETE FROM `$database`.`worker_history` WHERE ID = $id";
	$result = mysql_query($sql, $db);
	$sql = "DELETE * FROM `$database`.workers` WHERE id = $id";
	$result = mysql_query($sql, $db);
	if($result) {
		return true;
	}
	else {
		return false;
	}
	
}
?>