<?php
if(isset($_GET['name'])) {
include 'functions.php';
	$name = $_GET['name'];
	$clear = purge_stats($name);
	if ($clear) {
		header( 'Location: workers.php' ) ;
	}
	else{
		echo "failed to clear stats.";
	}
}
else {
	header( 'Location: workers.php' ) ;
}
?>