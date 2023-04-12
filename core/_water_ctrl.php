<?php
$func = $_POST['datas'];
$func();

//mayor's permit
function per_barangay()
{
  require_once('db_config.php');
  $a = '';
  $consump = '';
$sqls = "SELECT
project_name,
book,
project_location,
(SELECT SUM(usage_val) FROM sogod.meter_reading WHERE sogod.meter_reading.status = 'ACTIVE' AND sogod.meter_reading.posted = 'POSTED' AND sogod.meter_reading.trans_date BETWEEN '2022-12-01' AND '2022-12-31' AND sogod.meter_reading.zone_id = sogod.setup_zone.project_name GROUP BY sogod.meter_reading.zone_id) 'consumption'
FROM sogod.setup_zone
WHERE status = 'ACTIVE'";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    if ($row['consumption'] == null) {
        $consump = 0;
    } else {
      $consump = $row['consumption'];
    }
    $a = $a.'<li class="list-group-item">
    <span class="text-muted ">'.$row['project_location'].'</span> <br><a class="float-right">'.$consump.'</a>
     </li>';
  }
} else {
  $a = "0 results";
}

  echo $a;
}

function waterworks_summary()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE STATUS IN ('ACTIVE','APPROVED','DISCONNECTED')) AS 'total_services',
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE STATUS = 'ACTIVE') AS 'total_active',
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE mtr_no <> '') AS 'total_metered',
(SELECT COUNT(*) FROM sogod.meter_reading WHERE posted = 'POSTED') AS 'total_billed',
(SELECT COUNT(*) FROM sogod.meter_reading WHERE posted = 'UNPOSTED') AS 'total_unbilled',
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE STATUS = 'ACTIVE') AS 'total_population_served',
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE STATUS = 'ACTIVE' AND YEAR(DATE(application_date)) >= YEAR('2022-12-01') AND MONTH(DATE(application_date)) >= MONTH('2022-12-01')) AS 'total_new',
(SELECT COUNT(*) FROM sogod.setup_application_installation WHERE STATUS IN ('PERMANENT','DISCONNECTED')) AS 'total_disconnected',
(SELECT COUNT(*) FROM sogod.ledger WHERE trans_balance > '0') AS 'total_arrears'
FROM sogod.setup_application_installation
WHERE STATUS IN ('ACTIVE','APPROVED','DISCONNECTED')
LIMIT 1
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  while($rows = mysqli_fetch_assoc($result)) {

    $b = $b.'
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Total Services</p>
        <h3>'.$rows['total_services'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Total Active</p>
        <h3>'.$rows['total_active'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>For Disconnection</p>
        <h3>'.$rows['total_disconnected'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Total Inactive</p>
        <h3>'.$rows['total_new'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  ';
  }
} else {
  $b = "0 results";
}

  echo $b;
}

function for_disconnection()
{
  require_once('db_config.php');
  $b = '';
  $sqls = "SELECT
  setup_application_installation.id,
  setup_application_installation.account_no,
  setup_application_installation.acct_no,
  setup_application_installation.applicant,
  setup_application_installation.address,
  setup_application_installation.zone_id 'zone',
  (SELECT class_name FROM sogod.setup_rate WHERE sogod.setup_classification.id = sogod.setup_rate.classification_id AND sogod.setup_application_installation.rate = sogod.setup_rate.sizes_code) 'classification',
  sogod.setup_application_installation.status,
  (SELECT (SUM(debit) - SUM(credit)) FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id) 'balance',
  #(SELECT SUM(trans_balance) FROM ledger WHERE customer_id = setup_application_installation.id AND trans_balance > '0' AND TYPE = 'STAGGARD') 'staggard_balance',
  (SELECT trans_date FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id AND trans_type = 'PAYMENT BILLING' ORDER BY sogod.ledger.id DESC LIMIT 1) 'last_payment',
  sogod.setup_application_installation.status
  FROM sogod.setup_application_installation
  LEFT JOIN sogod.setup_classification
  ON sogod.setup_application_installation.rate_id = sogod.setup_classification.classification_code
  WHERE (SELECT SUM(trans_balance) FROM sogod.ledger WHERE sogod.ledger.customer_id = sogod.setup_application_installation.id) > '0'
  AND sogod.setup_application_installation.status = 'ACTIVE'
  AND sogod.setup_application_installation.is_disconnected = 'ACTIVE'
  GROUP BY sogod.setup_application_installation.id";
  $result = mysqli_query($conn, $sqls);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($rows = mysqli_fetch_assoc($result)) {

      $b = $b.'
      <tr>
      <td>'.$rows['applicant'].'</td>
      <td>'.$rows['address'].'</td>
      <td>'.$rows['zone'].'</td>
      <td>'.$rows['classification'].'</td>
      <td>'.$rows['status'].'</td>
      </tr>
      ';
    }
  } else {
    $b = "0 results";
  }
  echo $b;
}

?>
