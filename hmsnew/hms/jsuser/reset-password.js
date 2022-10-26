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
function getInfo(key) {
  data=sessionStorage.getItem(key);
  if(data==null){
    window.history.back();
  }
  return data;
}
var fullname=getInfo('fullname');
var email=getInfo('email');
$('form').submit(function (e) {
  e.preventDefault();
  var npass=$('input[name="password_again"]').val();
  var dataSend={
    event:'resetpassword',
    fullname:fullname,
    email:email,
    password:npass
  }
  queryDataPostJSon("../API/user/accout.php",dataSend,function (res) {
    if(res['resetpassword']==1){
      sessionStorage.clear();
      window.location.href ='../index.php';
    }else{
      alert_error(res['msg']);
    }
  })
})