var urls = 'core/_mayors_ctrl.php';
//mayor's permit
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'special_permit'},
    success : function (res){
     //alert(res)
      $('#special_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'dance_permit'},
    success : function (res){
     //alert(res)
      $('#dance_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cockfight_permit'},
    success : function (res){
     //alert(res)
      $('#cockfight_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'mahjong_permit'},
    success : function (res){
     //alert(res)
      $('#mahjong_permit').html(res);
    }
  });

  //regulatory permits
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'tricycle_permit'},
    success : function (res){
     //alert(res)
      $('#tricycle_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'trisikad_permit'},
    success : function (res){
     //alert(res)
      $('#trisikad_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'fishing_permit'},
    success : function (res){
     //alert(res)
      $('#fishing_permit').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'motorboat_permit'},
    success : function (res){
     //alert(res)
      $('#motorboat_permit').html(res);
    }
  });


  //Certificates of Clearances
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cert_noincome'},
    success : function (res){
     //alert(res)
      $('#cert_noincome').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cert_travel_abroad'},
    success : function (res){
     //alert(res)
      $('#cert_travel_abroad').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cert_mayor'},
    success : function (res){
     //alert(res)
      $('#cert_mayor').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cert_character'},
    success : function (res){
     //alert(res)
      $('#cert_character').html(res);
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'cert_recommendation'},
    success : function (res){
     //alert(res)
      $('#cert_recommendation').html(res);
    }
  });

  //Summary or total
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'total_mayor_permit'},
    success : function (res){
     //alert(res)
      $('#total_mayor_permit').html(res.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'total_regulatory_permit'},
    success : function (res){
     //alert(res)
      $('#total_regulatory_permit').html(res.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
    }
  });
  $.ajax({
    url:urls,
    type: 'POST',
    data: {datas : 'total_certificates_clearances'},
    success : function (res){
     //alert(res)
      $('#total_certificates_clearances').html(res.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
    }
  });



