<?php
require_once('db_config.php');
$b = '';
$x = '';
$sqls = "CALL cto_display_OR_Summary_1('2021-12-01', '2021-12-31');";
$results = mysqli_query($conn, $sqls);

if (mysqli_num_rows($results) != 0) {
  // output data of each row
  while($rows = mysqli_fetch_assoc($results)) {
    if ($rows['Total Collection'] == null ) {
      $x = "N/A";
    } else {
      $x = $rows['Total Collection'];
    }
    $b = $b.'
  <div class="col-lg-2">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Form '.$rows['Form No'].'</p>
        <h3>'.$x.'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>';
  }
} else {
  echo mysqli_error($conn);
}
echo $b;
?>
