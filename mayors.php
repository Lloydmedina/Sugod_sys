<?php
require_once('core/db_config.php');

$resp='';

$sql = "SELECT SUM(a.`net_amount`) 'Amount',a.`bill_date`'Date'
FROM `cto_general_billing` a
WHERE a.`status`<>'CANCELLED'
AND a.`bill_date` BETWEEN '2022-01-01' AND '2024-01-01'
GROUP BY DATE_FORMAT(a.`bill_date`,'%M %d %Y')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $resp = $resp.''.str_replace(',','',$row['Amount']) .',';
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
            <h1 class="m-0">Mayors</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-3">
                <div class="card">

                   <div class="card-body box-profile">
                   <div>
                    <b><span class="info-box-text">Mayor's Permit</span></b>
                  </div>
                  <br>
                     <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                       <span class="text-muted ">Special Permit</span> <br><p class="float-right" id="special_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Dance Permit</span> <br><p class="float-right" id="dance_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Cockfight Permit</span> <br><p class="float-right" id="cockfight_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Mahjong Permit</span> <br><p class="float-right" id="mahjong_permit"></p>
                     </li>
                     </ul>
                   </div>
                 </div>

                 <div class="card">

                   <div class="card-body box-profile">
                   <div>
                    <b><span class="info-box-text">Regulatory Permit</span></b>
                  </div>
                  <br>
                     <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                       <span class="text-muted ">Tricycle Permit</span> <br><p class="float-right" id="tricycle_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Trisikad Permit</span> <br><p class="float-right" id="trisikad_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Fishing Permit</span> <br><p class="float-right" id="fishing_permit"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Motorboat Permit</span> <br><p class="float-right" id="motorboat_permit"></p>
                     </li>
                     </ul>
                   </div>
                 </div>
                 <div class="card">

                   <div class="card-body box-profile">
                   <div>
                    <b><span class="info-box-text">Certificates of Clearances</span></b>
                  </div>
                  <br>
                     <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                       <span class="text-muted ">Certificate of No Income</span> <br><p class="float-right" id="cert_noincome"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Certificate for Travel Abroad</span> <br><p class="float-right" id="cert_travel_abroad"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Mayor`s Clearance</span> <br><p class="float-right" id="cert_mayor"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Character Certification</span> <br><p class="float-right" id="cert_character"></p>
                     </li>
                     <li class="list-group-item">
                       <span class="text-muted ">Mayor's Recommendation</span> <br><p class="float-right" id="cert_recommendation"></p>
                     </li>
                     </ul>
                   </div>
                 </div>
        </div>

          <div class="col-md-9">
            <!-- LINE CHART -->
            <div class="card">
              <div class="card-body">
                  <div>
                    <h3>Revenue Collection</h3>
                    <span class="text-muted ">As of : Dec. 1 - 31 , 2021</span>
                  </div>
                  <div>
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                  </div>
              </div>

            </div>
            <div class="info-box">
              <span class="info-box-icon"><i class="fas fa-sharp fa-solid fa-chart-pie lg"></i></span>

              <div class="info-box-content text-center">
                <span class="info-box-text">Mayor's Permit</span>
                <span class="info-box-number"><h1 class="m-1"id="total_mayor_permit"></h1></span>
              </div>
              <!-- /.info-box-content -->
            </div>

            <div class="info-box">
              <span class="info-box-icon"><i class="fas fa-sharp fa-solid fa-chart-pie lg"></i></span>

              <div class="info-box-content text-center">
                <span class="info-box-text">Regulatory Permit</span>
                <span class="info-box-number"><h1 class="m-1"id="total_regulatory_permit"></h1></span>
              </div>
              <!-- /.info-box-content -->
            </div>

            <div class="info-box">
              <span class="info-box-icon"><i class="fas fa-sharp fa-solid fa-chart-pie lg"></i></span>

              <div class="info-box-content text-center">
                <span class="info-box-text">Certificate or Clearances</span>
                <span class="info-box-number"><h1 class="m-1"id="total_certificates_clearances"></h1></span>
              </div>
              <!-- /.info-box-content -->
            </div>


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
<script src="jsx/mayors.js"></script>

<script>
   $('#mayors').addClass('active');
  $(document).ready(function(){
    getGraphData();
    loadGrap();
    getFormData();
    loadORSumary();
  });

function getGraphData(){
  $.ajax({
    url:'core/_get_graph_dtl.php',
    type : 'POST',
    success : function (res){
     // console.log(res)

    }
  });

}

function getFormData(){
  $.ajax({
    url:'core/_get_forms_dtl.php',
    type : 'POST',
    success : function (res){
     // console.log(res)
      $('#form_res').html(res);
    }
  });

}
function loadORSumary(){

  $.ajax({
    url:'core/_get_or_summary.php',
    type : 'POST',
    success : function (res){
    // console.log(res)
      $('#or_sumarry').html(res);
    }
  });
}
function loadGrap(){
  const cxt = document.getElementById("lineChart");
  const DATA_COUNT = <?php echo mysqli_num_rows($result) ?>;
  const labels = [];
for (let i = 1; i < DATA_COUNT; ++i) {
  labels.push(i.toString());
}
const datapoints =[<?php echo $resp;?>];
var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          },

        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }

    var areaChartData = {
      labels : labels,
      datasets : [
        {
        label : 'Collections',
        data : datapoints,
        backgroundColor : 'transparent',
        borderColor : 'skyblue',
        borderWidth : 1,
        fill: false,
        showLine:true,
        spanGaps : true,

      tension: 0.1,

        },
    ]
    }

  var myChart = new Chart(cxt,{
    type : 'line',
    data : areaChartData,
    options: areaChartOptions
  });
}

</script>
</body>
</html>
 2212