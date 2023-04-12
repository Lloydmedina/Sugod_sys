var urls = 'core/_water_ctrl.php';

  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'per_barangay'},
    success : function (res){
    // alert(res)
      $('#per_barangay').html(res);
    }
  });

$.ajax({
  url:urls,
  type: 'POST',
  data: {datas : 'waterworks_summary'},
  success : function (res){
  // alert(res)
    $('#waterworks_summary').html(res);
  }
});

$.ajax({
  url:urls,
  type: 'POST',
  data: {datas : 'for_disconnection'},
  success : function (res){
  // alert(res)
    $('#for_disconnection').html(res);
  }
});
