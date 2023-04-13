<?php
$func = $_POST['datas'];
$func();

function hr_summary_count()
{
  require_once('db_config.php');
  $b = '';
$sqls = "SELECT
SUM(Permanent) 'Permanent',
SUM(Casual) 'Casual',
SUM(JobOrder) 'Job Order',
SUM(Elective) 'Elective'
FROM (
SELECT
 IF(payrolltype='Permanent',1,0) 'Permanent',
 IF(payrolltype='Casual',1,0) 'Casual',
 IF(payrolltype='Job Order',1,0) 'JobOrder',
 IF(payrolltype='Elective',1,0) 'Elective'
FROM  `humanresource`.employees
WHERE Status_Empl='Active'
AND payrolltype!=''
)xx
";
$result = mysqli_query($conn, $sqls);

if (mysqli_num_rows($result) > 0) {
  while($rows = mysqli_fetch_assoc($result)) {

    $b = $b.'
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Elective and Co-Terminous</p>
        <h3>'.$rows['Elective'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Permanent</p>
        <h3>'.$rows['Permanent'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Casuals</p>
        <h3>'.$rows['Casual'].'</h3>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="small-box">
      <div class="inner" style="text-align: center;">
        <p>Job Orders</p>
        <h3>'.$rows['Job Order'].'</h3>
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

function gender_summary()
{
  require_once('db_config.php');

$a = '';

$sql = "SELECT
SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male,
SUM(CASE WHEN gender = 'FeMale' THEN 1 ELSE 0 END) AS FeMale,
SUM(CASE WHEN DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),BirthDate_Empl)), '%Y') + 0 >=60  THEN 1 ELSE 0 END) AS Senior,
SUM(CASE WHEN  person_disablity='Yes'  THEN 1 ELSE 0 END) AS PWD
FROM `humanresource`.employees
WHERE Status_Empl='Active'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    $a = $a.'
    <ul class="list-group list-group-unbordered mb-3" >
    <li class="list-group-item">
        <span class="text-muted ">Male</span> <br><a class="float-right">'.$row['Male'].'</a>
     </li>
     <li class="list-group-item">
     <span class="text-muted ">Female</span> <br><a class="float-right">'.$row['FeMale'].'</a>
      </li>
      <li class="list-group-item">
      <span class="text-muted ">Senior Citizen</span> <br><a class="float-right">'.$row['Senior'].'</a>
      </li>

      <li class="list-group-item">
      <span class="text-muted ">PWD</span> <br><a class="float-right">'.$row['PWD'].'</a>
      </li>
      </ul>
     ';
  }
} else {
  $a = "0 results";
}
  echo $a;
}

function logs_summary()
{
  require_once('db_config.php');

  $a = '';

  $sql = "SELECT  b.`Name_Dept` AS Department,
	SUM(CASE WHEN a.gender = 'Male' THEN 1 ELSE 0 END) AS Male,
	SUM(CASE WHEN a.gender = 'FeMale' THEN 1 ELSE 0 END) AS FeMale,
	SUM(CASE WHEN DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),a.BirthDate_Empl)), '%Y') + 0 >=60  THEN 1 ELSE 0 END) AS Senior,
	SUM(CASE WHEN  a.person_disablity='Yes'  THEN 1 ELSE 0 END) AS PWD
FROM `humanresource`.employees a
INNER JOIN  `humanresource`.`department` b
ON a.`Department_Empl` = b.`SysPK_Dept`
WHERE a.Status_Empl='Active'
GROUP BY b.`SysPK_Dept`
ORDER BY b.`sortby` ASC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

      $a = $a.'
      <tr>
      <td>'.$row['Department'].'</td>
      <td>'.$row['Male'].'</td>
      <td>'.$row['FeMale'].'</td>
      <td>'.$row['Senior'].'</td>
      <td>'.$row['PWD'].'</td>
      </tr>
       ';
    }
  } else {
    $a = "0 results";
  }
    echo $a;
}
?>
