<?php
require_once('db_config.php');
// $start = $_POST['start'] == null ? '2021-12-01': $_POST['start'];
// $end = $_POST['end']== null ? '2021-12-31': $_POST['end'];
$resp='';
$xside = '';
$yside = '';


$sql = "SELECT
DeptCode_Dept 'Code',
Name_Dept 'Assigned_Department',
`short_desc` 'Department',
COUNT(Name_Dept) 'Total'
FROM `humanresource`.employees
INNER JOIN `humanresource`.department ON designate_dept=department.SysPK_Dept
WHERE Status_Empl='Active'
GROUP BY SysPK_Dept";
$rows = $conn->query($sql);
$rowcount = $rows->num_rows;
if ($rows->num_rows > 0) {
  while($row = $rows->fetch_assoc()) {
    $xside .=''.str_replace(',','',$row['Total']) .',';
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
