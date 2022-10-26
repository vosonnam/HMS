var localData=localStorage.getItem("id");
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
$('#email').change(function (e) {
  e.preventDefault();
  userAvailability();
})
$('#submit').click(function (e) {
  e.preventDefault();
  var uemail=$('#email').val();
  var dataSend={
    event:'editemail',
    id:localData,
    email:uemail
  }
  queryDataPostJSon("../API/user/accout.php",dataSend,function (res) {
    if(res['editemail']){
      alert_success(res['msg'], function (rs) {
        window.history.back();
      });
    }else{
      alert_error(res['msg']);
    }
  })
})