<?php
$func = $_POST['datas'];
$func();

//mayor's permit
function special_permit()
{
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
} else {
  $b = "0 results";
}

  echo $b;
}

function dance_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Dance Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}
function cockfight_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Cockfight Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`

";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function mahjong_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Mahjong Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

//regulatory permits
function tricycle_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Tricycle Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function trisikad_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Trisikad Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function fishing_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Fishing Permit'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`

";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function motorboat_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Motorboat Operation'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`

";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

//Certificates of Clearances
function cert_noincome()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Certificate of No Income'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function cert_travel_abroad()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Certificate for Travel Abroad'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function cert_mayor()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Mayor`s Clearance'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function cert_character()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Character Certification'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

function cert_recommendation()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT a.`SysPK_general_billing`, a.`bill_id`,a.`bill_date`,a.`transaction_type`
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` = 'Mayor`s Recommendation'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY a.`bill_id`
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  $b = mysqli_num_rows($result) ;
} else {
  $b = "0 results";
}

  echo $b;
}

//Summary or total

function total_mayor_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT SUM(a.`net_amount`) as total
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` IN ('Special Permit','Dance Permit','Cockfight Permit','Mahjong Permit')
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
";
$result = mysqli_query($conn, $sqls);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $b = $row['total'];
  }
} else {
  $b = "0 results";
}

  echo $b;
}

function total_regulatory_permit()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT SUM(a.`net_amount`) as total
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`transaction_type` IN ('Tricycle Permit','Trisikad Permit','Fishing Permit','Motorboat Operation')
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $b = $row['total'];
    }
} else {
  $b = "0 results";
}

  echo $b;
}

function total_certificates_clearances()
{
  require_once('db_config.php');
  $b = '';
  $sqls = "SELECT SUM(a.`net_amount`) as total
  FROM `cto_general_billing` a
  WHERE a.`status`<>'CANCELLED'
  AND a.`transaction_type` IN ('Certificate of No Income','Character Certification','Certificate for Travel Abroad','Mayor`s Clearance','Mayor`s Recommendation')
  AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
  ";
  $result = mysqli_query($conn, $sqls);

  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $b = $row['total'];
      }
  } else {
    $b = "0 results";
  }

    echo $b;
}
?>
