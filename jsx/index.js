$.ajax({
  url:'core/_get_forms_dtl.php',
  type : 'POST',
  success : function (res){
   // console.log(res)
    $('#form_res').html(res);
  }
});

$.ajax({
  url:'core/_get_or_summary.php',
  type : 'POST',
  success : function (res){
   //console.log(res)
    $('#or_sumarry').html(res);
  }
});

