<?php
require_once('db_config.php');
$start = $_POST['start'] == null ? '2021-12-01': $_POST['start'];
$end = $_POST['end']== null ? '2021-12-31': $_POST['end'];
$resp='';
$xside = '';
$yside = '';
$sql = "SELECT SUM(a.`net_amount`) 'Amount',a.`bill_date`'Date'
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`bill_date` BETWEEN '$start' AND '$end'
GROUP BY DATE_FORMAT(a.`bill_date`,'%M %d %Y')";
$rows = $conn->query($sql);
$rowcount = $rows->num_rows;
if ($rows->num_rows > 0) {
  while($row = $rows->fetch_assoc()) {
    $xside .=''.str_replace(',','',$row['Amount']) .',';
    $yside .= '"'.$rows->num_rows.'",';
    //$xside .= $row['OR Amount'];
  }
}
$xside = substr($xside, 0, -1);
$yside = substr($yside, 0, -1);
$resp = '
  <canvas id="graph"data-settings=
  \'{
    "type" : "line",
    "data" : {
      "labels" : ['.$yside.'],
      "dataset" :
       [{
        "label" : "Collections",
        "data" : ['.$xside.'],
        "backgroundColor" : "transparent",
        "borderColor" : "skyblue",
        "borderWidth" : 3,
        "fill": false
      }]
    }

  }\'
  ></canvas>

';

echo $xside;
mysqli_close($conn);

?>
