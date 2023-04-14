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
                    <!-- <div class="form-group">
                      <label>Department</label>
                      <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                      </select>
                    </div> -->
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
<?php
include 'components/includes.php';
?>
<script src="jsx/hris.js"></script>

<script>
   $('#hris').addClass('active');
   $(document).ready(function(){
    processData(null,null);
  $('#reservation').daterangepicker({
    "startDate": "12/01/2021",
    "endDate": "12/31/2021"
}, function(start, end) {
  console.log(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  processData(start.format('YYYY-MM-DD') , end.format('YYYY-MM-DD'));
});
});

function processData(starts, ends){
  $.ajax({
    url:'core/_hris_graph.php',
    type : 'POST',
    data : {start : starts , end : ends },
    success : function (res){
      console.log("this is the result",res);
      let a = res;
      let b = Array.from(a.split(','),Number);
      var cxt = document.getElementById("lineChart").getContext('2d');
  const DATA_COUNT = Array.from(a.split(','),Number).length;
  const labels = [];
for (let i = 1; i < DATA_COUNT; ++i) {
  labels.push(i.toString());
}

const datapoints =[b][0];
console.log(datapoints);
// console.log("from php",datapoints1);
  var myChart = new Chart(cxt,{
    type : 'line',
    data : {
      labels : labels,
      datasets : [
        {
        label : 'No. Employees',
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
  });
}


</script>
</body>
</html>
