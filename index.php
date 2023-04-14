<?php
require_once('core/db_config.php');
$resp='';
$a = '';

$sql = "CALL jay_dispaly_cto_incomeAcnt_list ('2','','','', '2021-12-01', '2021-12-31','Remitted')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $resp = $resp.''.str_replace(',','',$row['OR Amount']) .',';
    $a = $a.'<li class="list-group-item">
    <b>'.$row['Sub-Classification'].'</b> <br><a class="float-right">'.$row['OR Amount'].'</a>
     </li>';
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
            <h1 class="m-0">Treasury</h1>
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
          <div class="row" id="form_res"></div>
        </div>

          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card">
              <div class="card-body">
              <div class="row">
                <div class="chart col-sm-9">
                  <div>
                    <h3>Revenue Collection</h3>
                    <div class="form-group">
                      <label class="text-muted ">As of :</label>

                      <div class="input-group col-sm-6">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation">
                      </div>
                    </div>

                  </div>
                  <div id="graps">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-sm-3">
                  <br>
                  <div class="card">
                   <div class="card-body box-profile">
                     <ul class="list-group list-group-unbordered mb-3">
                     <?php
                     echo $a;
                        ?>
                     </ul>
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
                <h3 class="card-title"><b>OR Summary</b></h3>
              </div>
              <br>
               <table class="table">
  <thead>
    <tr>
      <th scope="col"><span class="text-muted ">Form No. and Type</span></th>
      <th scope="col"><span class="text-muted ">OR Total Count</span></th>
      <th scope="col"><span class="text-muted ">OR Balance</span></th>
      <th scope="col"><span class="text-muted ">OR Cancelled</span></th>
      <th scope="col"><span class="text-muted ">OR Remitted</span></th>
      <th scope="col"><span class="text-muted ">OR Active</span></th>

    </tr>
  </thead>
  <tbody id="or_sumarry">

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
<script src="jsx/index.js"></script>
<script>
   $('#treasury').addClass('active');
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
    url:'core/_get_graph_dtl.php',
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
        label : 'Collections',
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
