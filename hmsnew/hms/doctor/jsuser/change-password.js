var currentPage=0;
var localData=localStorage.getItem("id");
function valid(){
  if(document.chngpwd.oldpass.value==""){
    alert_error("Mật khẩu cũ không được trống!!");
    document.chngpwd.oldpass.focus();
    return false;
  }else if(document.chngpwd.newpass.value==""){
    alert_error("Mật khẩu mới không được trống!!");
    document.chngpwd.newpass.focus();
    return false;
  }else if(document.chngpwd.cfpass.value==""){
    alert_error("Mật khẩu lặp lại không được trống!!");
    document.chngpwd.cfpass.focus();
    return false;
  }else if(document.chngpwd.newpass.value!= document.chngpwd.cfpass.value){
    alert_error("Mật khẩu mới và mật khẩu lặp lại không trùng khớp!!");
    document.chngpwd.cfpass.focus();
    return false;
  }
  return true;
}
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/doctors/accout.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=changepassword&id='+localData;
  if(valid()){
    queryDataPostJSon(url,dataSend,function (res) {
      if(res['changepassword']){
        alert_success(res['msg'], function (rs) {
          window.history.back();
        });
      }else{
        alert_error(res['msg']);
      }
    });
  }
});