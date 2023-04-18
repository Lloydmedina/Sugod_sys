<?php
 require_once('db_config.php');

$output= array();
$sql = "SELECT
setup_application_installation.id,
setup_application_installation.account_no,
setup_application_installation.acct_no,
setup_application_installation.applicant,
setup_application_installation.address,
setup_application_installation.zone_id 'zone',
(SELECT class_name FROM sogod.setup_rate WHERE sogod.setup_classification.id = sogod.setup_rate.classification_id AND sogod.setup_application_installation.rate = sogod.setup_rate.sizes_code) 'classification',
sogod.setup_application_installation.status,
(SELECT (SUM(debit) - SUM(credit)) FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id) 'balance',
(SELECT trans_date FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id AND trans_type = 'PAYMENT BILLING' ORDER BY sogod.ledger.id DESC LIMIT 1) 'last_payment',
sogod.setup_application_installation.status
FROM sogod.setup_application_installation
LEFT JOIN sogod.setup_classification
ON sogod.setup_application_installation.rate_id = sogod.setup_classification.classification_code
WHERE (SELECT SUM(trans_balance) FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id) > '0'
AND sogod.setup_application_installation.status = 'ACTIVE'
AND sogod.setup_application_installation.is_disconnected = 'ACTIVE'
GROUP BY sogod.setup_application_installation.id";

$rows = array();
$totalQuery = mysqli_query($conn,$sql);
//$total_all_rows = mysqli_num_rows($totalQuery);
 while($row = mysqli_fetch_array($totalQuery)){
  $rows[] = $row;
 }
echo json_encode($rows);
// $columns = array(
// 	0 => 'id',
// 	1 => 'account_no',
// 	2 => 'applicant',
// 	3 => 'address',
// 	4 => 'zone',
//   5 => 'classification',
//   6 => 'status',
// );

// if(isset($_POST['search']['value']))
// {
// 	$search_value = $_POST['search']['value'];
// 	$sql .= " WHERE account_no like '%".$search_value."%'";
// 	$sql .= " OR applicant like '%".$search_value."%'";
// 	$sql .= " OR address like '%".$search_value."%'";
// 	$sql .= " OR zone like '%".$search_value."%'";
//   $sql .= " OR classification like '%".$search_value."%'";
//   $sql .= " OR status like '%".$search_value."%'";
// }

// if(isset($_POST['order']))
// {
// 	$column_name = $_POST['order'][0]['column'];
// 	$order = $_POST['order'][0]['dir'];
// 	$sql .= " ORDER BY '".$column_name."' ".$order."";
// }
// else
// {
// 	$sql .= " ORDER BY id desc";
// }

// if($_POST['length'] != -1)
// {
// 	$start = $_POST['start'];
// 	$length = $_POST['length'];
// 	$sql .= " LIMIT  ".$start.", ".$length;
// }

// $data = array();
// $query = mysqli_query($conn,$sql);
// $count_rows = mysqli_num_rows($query);
// while($row = mysqli_fetch_assoc($query))
// {
// 	$sub_array = array();
// 	$sub_array[] = $row['id'];
// 	$sub_array[] = $row['account_no'];
// 	$sub_array[] = $row['applicant'];
// 	$sub_array[] = $row['address'];
// 	$sub_array[] = $row['zone'];
//   $sub_array[] = $row['classification'];
//   $sub_array[] = $row['status'];
// 	$data[] = $sub_array;
// }

// $output = array(
//   'data'=>$data,
// 	'draw'=> intval($_POST['draw']),
// 	'recordsTotal' =>$total_all_rows ,
// 	'recordsFiltered'=>$count_rows,
// );
// echo  json_encode($output);
?>
