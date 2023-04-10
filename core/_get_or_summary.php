<?php
require_once('db_config.php');
$b = '';
$sqls = "CALL cto_display_OR_Summary_1('2021-12-01', '2021-12-31')";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($rows = mysqli_fetch_assoc($result)) {

    $b = $b.'
    <tr>
    <th scope="row">'.$rows['Collection Type'].'</th>
    <td>'.$rows['OR Total Count'].'</td>
    <td>'.$rows['OR Balance'].'</td>
    <td>'.$rows['OR Cancelled'].'</td>

    <td>'.$rows['OR Remitted'].'</td>
    <td>'.$rows['OR Active'].'</td>
    </tr>
    ';
  }
} else {
  $b = "0 results";
}
echo $b;
?>
