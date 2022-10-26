function queryDataPostJSon(url,dataSend,callback){
    
    $.ajax({
        type: 'POST',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
function alert_error(mes){
    bootbox.alert({
    size: "small",
    title: "<h4 style='color: red'>Thất bại</h4>",
    message: mes,
    callback: function(){ /* your callback code */}
  });
}
$('form').submit(function (e) {
  e.preventDefault();
  var fullname=$('input[name="fullname"]').val();
  var email=$('input[name="email"]').val();
  var dataSend={
    event:'iduser',
    fullname:fullname,
    email:email
  }
  queryDataPostJSon("../API/user/accout.php",dataSend,function (res) {
    if(res['iduser']==1){
      sessionStorage.setItem("fullname",fullname);
      sessionStorage.setItem("email",email);
      window.location.href ='reset-password.php';
    }else{
      alert_error(res['msg']);
    }
  })
})