<?php
require_once('db_config.php');
$start = $_POST['start'] == null ? '2021-12-01': $_POST['start'];
$end = $_POST['end']== null ? '2021-12-31': $_POST['end'];
$resp='';
$xside = '';
$yside = '';


$sql = "SELECT sogod.ledger.trans_date'Date',FORMAT(SUM(credit),2) 'Collection'
FROM sogod.ledger
INNER JOIN sogod.setup_application_installation
ON (sogod.ledger.customer_id = sogod.setup_application_installation.id)
INNER JOIN sogod.setup_zone
ON sogod.setup_application_installation.zone_id = sogod.setup_zone.project_name
WHERE sogod.ledger.trans_date BETWEEN '$start' AND '$end'
AND sogod.ledger.trans_type IN ('PAYMENT BILLING','Discount BILLING')
AND sogod.setup_application_installation.zone_id = sogod.setup_zone.project_name
GROUP BY sogod.ledger.trans_date";
$rows = $conn->query($sql);
$rowcount = $rows->num_rows;
if ($rows->num_rows > 0) {
  while($row = $rows->fetch_assoc()) {
    $xside .=''.str_replace(',','',$row['Collection']) .',';
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
