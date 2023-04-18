


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
            <h1 class="m-0">Waterworks</h1>
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
          <div class="row" id="waterworks_summary"></div>
        </div>

          <div class="col-md-9">
            <!-- LINE CHART -->
            <div class="card">
            <div class="card-body">
              <div>
                    <h3>Water Collection</h3>
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
                  <div>
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                  </div>
              </div>

            </div>

            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
              <div class="">
                <h3 class="card-title"><b>For Disconnection</b></h3>
              </div>
              <br>
                <table class="table" id="summary_discon">
                  <thead>
                    <tr>
                      <th scope="col"><span class="text-muted ">Customer Name</span></th>
                      <th scope="col"><span class="text-muted ">Barangay</span></th>
                      <th scope="col"><span class="text-muted ">Zone</span></th>
                      <th scope="col"><span class="text-muted ">Classification</span></th>
                      <th scope="col"><span class="text-muted ">Status</span></th>
                    </tr>
                  </thead>
                  <tbody>
                  <!-- <tbody id="for_disconnection"> -->
                    <?php
                      require_once('core/db_config.php');
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

                        echo $b.'
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
                        echo "0 results";
                      }


                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-3">
                  <div class="card">

                   <div class="card-body box-profile">
                   <div class="">
                <h3 class="card-title"><b>Per Barangay</b></h3>
              </div>
              <br><br>

                     <ul class="list-group list-group-unbordered mb-3" id="per_barangay">
                     </ul>
                   </div>
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
<?php
include 'components/includes.php';
?>
<script src="jsx/water.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
   $('#water').addClass('active');
  $(document).ready(function(){


    //loadGrap();

    $(function () {
    $("#summary_discon").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,

    }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
    $('#example2').DataTable({
      'bPaginate': true,
      'bProcessing':true,

      "lengthChange": false,
      "searching": false,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [20, 40, 60, 80, 100],
        "pageLength": 10
    });
  });

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
    url:'core/_water_graph.php',
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
