<?php
require_once('db_config.php');

  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Special Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
  // output data of each row
  // while($rows = mysqli_fetch_assoc($result)) {

  //   $b = $b.'
  //   <tr>
  //   <th scope="row">'.$rows['Collection Type'].'</th>
  //   <td>'.$rows['OR Total Count'].'</td>
  //   <td>'.$rows['OR Balance'].'</td>
  //   <td>'.$rows['OR Cancelled'].'</td>

  //   <td>'.$rows['OR Remitted'].'</td>
  //   <td>'.$rows['OR Active'].'</td>
  //   </tr>
  //   ';
  // }
} else {
  $b = "0 results";
}
echo $b;
?>
