var localData=localStorage.getItem("id");
function checkemailAvailability() {
  var url= "../../API/doctors/select_doctors.php";
  dataSend={
    event:'checkemail',
    email:$("#patemail").val()
  }
  queryDataPostJSon(url,dataSend,function (res) {
    $("#user-availability-status").html(res["html"]);
    $("#user-availability-status").data("checked",res['checkemail']);
  });
}
$("#patemail").change(function () {
  checkemailAvailability();
})
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/doctors/new_doctors.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=addpatient&id='+localData;
  var check=$("#user-availability-status").data("checked");
  if(check==1){
    queryDataPostJSon(url,dataSend,function (res) {
      if(res['addpatient']){
        alert_success(res['msg'], function (rs) {
          window.location.href ='add-patient.php';
        });
      }else{
        alert_error(res['msg']);
      }
    });
  }else{
    alert_error($("#user-availability-status").text());
  }
});