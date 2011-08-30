<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
<script src="./js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/modules/exporting.js"></script>

<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include "functions.php";
//$usd = get_mtgox();
$worker_names = get_worker_names();

$how_many = count($worker_names);


$i = 1;
$current_hashrate = 0;
foreach($worker_names as $value) {
	$current_hashrate += get_current_hashrate($i);
	$i++;
	}

include "nav.php";
include "quick_stats.php"; ?>


<div id="container">
<h2>Last Hour</h2>
<div id="recent_hashrate"></div>
<h2>Last 24 Hours</h2>
<div id="hashrate"></div>
<?php $times = get_times();

//echo $times;
?>

</div>
<script type="text/javascript">
var chart2;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'recent_hashrate',
         defaultSeriesType: 'area'
      },
	  credits: {
	  enabled: false
	  },
      title: {
         text: 'Last Hour Hashrate'
      },
      subtitle: {
         text: 'Source: Mining Pool APIs'
      },
	  xAxis: {
			type: 'datetime'
			},
      yAxis: {
         title: {
            text: 'Hashrate (mh/s)'
         }
      },
      tooltip: {
			 formatter: function() {
            var s = '<b>' + Highcharts.dateFormat('%H:%M, %A, %b %e, %Y',this.x) +'</b>';
			var total = 0;
            
            $.each(this.points, function(i, point) {
                s += '<br/><span style=" color: ' + this.series.color + ';">'+ point.series.name +':</span> '+
                    point.y +' mh/s';
					
                total = total + point.y;
            });
            s += '<br/>Total: '+ total +' mh/s';
            return s;
        },
		enabled: true,
		shared: true,
		crosshairs: true
      },
     plotOptions: {
         area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
               lineWidth: 1,
               lineColor: '#666666'
            }
         }
      },
      series: [
		<?php
		
		$i = 1;
		$current_hashrate = 0;
		foreach($worker_names as $value) {
			$data = get_worker_1h($i);
			$i++;
			if ($data != null) {
			echo "{
			name: '".$value."',"."
			data: $data
			}";
			if ($i <= count($worker_names)) {
			echo ",
			";}
			}
		}
		?>
         
	  ]
   });
   
   
});


var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'hashrate',
         defaultSeriesType: 'area'
      },
	  credits: {
	  enabled: false
	  },
      title: {
         text: '24 Hour Hashrate'
      },
      subtitle: {
         text: 'Source: Mining Pool APIs'
      },
      xAxis: {
         categories: [<?php echo $times; ?>]
      },
      yAxis: {
         title: {
            text: 'Hashrate (mh/s)'
         }
      },
      tooltip: {
			 formatter: function() {
            var s = '<b>'+ this.x +':00</b>';
			var total = 0;
            
            $.each(this.points, function(i, point) {
                s += '<br/><span style=" color: ' + this.series.color + ';">'+ point.series.name +':</span> '+
                    point.y +' mh/s';
					
                total = total + point.y;
            });
            s += '<br/>Total: '+ total +' mh/s';
            return s;
        },abled: true,
		shared: true,
		crosshairs: true
      },
     plotOptions: {
         area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
               lineWidth: 1,
               lineColor: '#666666'
            }
         }
      },
      series: [
		<?php
		
		$i = 1;
		$current_hashrate = 0;
		foreach($worker_names as $value) {
			$data = get_worker_24h($i);
			$i++;
			echo "{
			name: '".$value."',"."
			data: [".$data."]
			}";
			if ($i <= count($worker_names)) {
			echo ",
			";
			}
		}
		?>
         
	  ]
   });
   
   
});

</script>
</body>
</html>