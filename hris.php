<?php
require_once('core/db_config.php');
$resp='';
$lbl = '';

$sql = "SELECT
DeptCode_Dept 'Code',
Name_Dept 'Assigned_Department',
`short_desc` 'Department',
COUNT(Name_Dept) 'Total'
FROM `humanresource`.employees
INNER JOIN `humanresource`.department ON designate_dept=department.SysPK_Dept
WHERE Status_Empl='Active'
GROUP BY SysPK_Dept";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $resp = $resp.''.str_replace(',','',$row['Total']) .',';
    $lbl = $lbl.''.str_replace(',','',json_encode($row["Department"])).',';
  }

} else {
  echo "0 results";
}


?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php
include 'components/header.html';
?>
<body class="hold-transition sidebar-mini ">
<div class="wrapper">
<?php
include 'components/nav_header.php';
include 'components/nav_sider.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">HRIS</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
          <div class="row" id="hr_summary_count"></div>
        </div>

          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card">
              <div class="card-body">
              <div class="row">
                <div class="chart col-sm-9">
                  <div>
                    <h3>Department Employee Count</h3>
                    <span class="text-muted ">As of : Dec. 1 - 31 , 2021</span>
                  </div>
                  <div>
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-sm-3">
                  <br>
                  <div class="card">
                   <div class="card-body box-profile" id="gender_summary">

                   </div>
                 </div>
                </div>
              </div>
              </div>

            </div>


          </div>

          <div class="col-md-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
              <div class="">
                <h3 class="card-title"><b>Incomplete Logs</b></h3>
              </div>
              <br>
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col"><span class="text-muted ">Department</span></th>
                      <th scope="col"><span class="text-muted ">Male</span></th>
                      <th scope="col"><span class="text-muted ">Female</span></th>
                      <th scope="col"><span class="text-muted ">Senior Citizen</span></th>
                      <th scope="col"><span class="text-muted ">PWD</span></th>
                    </tr>
                  </thead>
                  <tbody id="logs_summary">

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="/sugod_sys">Municipality of Sugod</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/chart.js/Chart.bundle.min.js"></script>
<script src="plugins/moment/moment-with-locales.min.js"></script>
<script src="jsx/hris.js"></script>

<script>
   $('#hris').addClass('active');
loadGrap();


function loadGrap(){
  var cxt = document.getElementById("lineChart").getContext('2d');
  const DATA_COUNT = 32;
  const labels = [<?php echo $lbl;?>];
// for (let i = 1; i < DATA_COUNT; ++i) {
//   labels.push(i.toString());
// }
const datapoints =[<?php echo $resp;?>];
//const datapoints =[data];
  var myChart = new Chart(cxt,{
    type : 'line',
    data : {
      labels : labels,
      datasets : [
        {
        label : 'No of Employee',
        data : datapoints,
        backgroundColor : 'transparent',
        borderColor : 'skyblue',
        borderWidth : 3,
        fill: false,
      cubicInterpolationMode: 'monotone',
      tension: 0.4,

        },
    ]
    },
    options: {
      showLine: false,
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: '_'
      },
    },
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        showLine: false ,
        beginAtZero : false,
        display: true,

        title: {
          display: true
        }
      },
      y: {
        autoskip: true,
        maxTicketsLimit:20,
        display: true,

        title: {
          display: true,
          text: 'Value'
        },
        suggestedMin: -10,
        suggestedMax: 200
      }
    }
  }
  });
}


</script>
</body>
</html>
