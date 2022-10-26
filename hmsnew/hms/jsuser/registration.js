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
function valid(){
  if(document.registration.password.value!= document.registration.password_again.value){
    alert_error("Mật khẩu và mật khẩu lặp lại không trùng khớp!!");
    document.registration.password_again.focus();
    return false;
  }
  return true;
}
function userAvailability() {
  $("#loaderIcon").show();
  dataSend={
    event:'checkemail',
    email:$("#email").val()
  }
  queryDataPostJSon("../API/user/accout.php",dataSend,function (res) {
    $("#user-availability-status").html(res["html"]);
    $("#loaderIcon").hide();
  });
}
$("#email").change(function(e) {
  e.preventDefault();
  userAvailability();
})
$("#password_again").change(function(e) {
  e.preventDefault();
  valid();
})
$('form').submit(function(e){
  e.preventDefault();
  var url= "../API/user/accout.php";
  var dataSend='event=newuser&';
  dataSend+=$('form').serialize();
  if(valid()){
    queryDataPostJSon(url,dataSend,function (res) {
      if(res['newuser']){
        alert_success(res['msg'], function (rs) {
          window.location.href ='../index.html';
        });
      }else{
        alert_error(res['msg']);
      }
    });
  }
});