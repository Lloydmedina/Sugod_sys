var urls = 'core/_hris_ctrl.php';

  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'hr_summary_count'},
    success : function (res){
    // alert(res)
      $('#hr_summary_count').html(res);
    }
  });


  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'gender_summary'},
    success : function (res){
    //alert(res)
     $('#gender_summary').html(res);
    }
  });

  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'logs_summary'},
    success : function (res){
    //alert(res)
    $('#logs_summary').html(res);
    }
  });
