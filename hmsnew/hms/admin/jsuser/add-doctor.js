queryDataPostJSon("../../API/admin/select_admin.php",{event:'Doctorspecialization'},function (res) {
  var data=res['Doctorspecialization'];
  buildSelect($("select[name='docspecialization']"),data);
})
function valid()
{;
  if($("input[name='npass']").val()!= $("input[name='cfpass']").val()){
    alert_info("Mật khẩu và mật khẩu lặp lại không trùng khớp!!");
    return false;
  }
  return true;
}
function checkemailAvailability() {
  $("#loaderIcon").show();
  var url= "../../API/admin/select_admin.php";
  dataSend={
    event:'checkemail',
    emailid:$("#docemail").val()
  }
  queryDataPostJSon(url,dataSend,function (res) {
    $("#email-availability-status").html(res["html"]);
    $("#loaderIcon").hide();
  });
}
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/admin/new_admin.php";
  var dataSend='event=doctors&';
  dataSend+=$('form').serialize();
  if(valid()){
    queryDataPostJSon(url,dataSend,function (res) {
      if(res['doctors']){
        alert_success(res['msg'], function (rs) {
          window.location.href ='add-doctor.php';
        });
      }else{
        alert_error(res['msg']);
      }
    });
  }
});