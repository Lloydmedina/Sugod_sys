<?php
require_once('db_config.php');
$resp='';
$sql = "CALL jay_dispaly_cto_incomeAcnt_list ('2','','','', '2021-12-01', '2021-12-31','Remitted')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $resp = $resp.''.str_replace(',','',$row['OR Amount']) .',';
  }
} else {
  echo "0 results";
}
echo trim($resp,",");
mysqli_close($conn);

?>
