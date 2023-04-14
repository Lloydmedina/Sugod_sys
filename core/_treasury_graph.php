<?php
require_once('db_config.php');
$start = $_POST['start'] == null ? '2021-12-01': $_POST['start'];
$end = $_POST['end']== null ? '2021-12-31': $_POST['end'];
$resp='';
$xside = '';
$yside = '';
$sql = "CALL jay_dispaly_cto_incomeAcnt_list ('2','','','', '$start', '$end','Remitted')";
$rows = $conn->query($sql);
$rowcount = $rows->num_rows;
if ($rows->num_rows > 0) {
  while($row = $rows->fetch_assoc()) {
    $xside .=''.str_replace(',','',$row['OR Amount']) .',';
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
