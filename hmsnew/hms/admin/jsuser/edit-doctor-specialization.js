var currentPage=0;
function getSpecilizationId() {
  var data=sessionStorage.getItem("doctorspecilization");
  var dataName=sessionStorage.getItem("specilization");
  if(data==null){
    window.history.back();
  }
  $('input[name="specilization"]').val(dataName);
  return data;
}
var  localData=getSpecilizationId();
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/admin/set_admin.php";
  var data=$('input[name="specilization"]').val();
  var dataSend={
    event:'doctorspecilization',
    id:localData,
    specilization:data
  }
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['doctorspecilization']){
      alert_success(res['msg'], function (rs) {
        sessionStorage.removeItem('specilization');
        sessionStorage.removeItem('doctorspecilization');
        window.location.href ='doctor-specilization.php';
      });
    }else{
      alert_error(res['msg']);
    }
  });
});
