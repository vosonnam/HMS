function getPatientId() {
  var data=sessionStorage.getItem("patient");
  if(data==null){
    window.location.href ='dashboard.php';
  }
  return data;
}
var  localData=getPatientId();
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/doctors/new_doctors.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=medicalhistory&id='+localData;
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['medicalhistory']){
      alert_success(res['msg'], function (rs) {
        window.location.href ='view-patient.php';
        window.history.back();
      });
    }else{
      alert_error(res['msg']);
    }
  });
});
