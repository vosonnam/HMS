function getPatientId() {
  var data=sessionStorage.getItem("patient");
  if(data==null){
    window.history.back();
  }
  return data;
}
var  localData=getPatientId();
queryDataPostJSon("../../API/doctors/select_doctors.php",{event:'tblpatient',id:localData},function (res) {
  var data=res['tblpatient'];
  for( item in data){
    switch(item){
      case 'PatientGender':
        if(('Male'.localeCompare(data[item]))==0){
          $('input[value="Male"]').attr("checked","true");
          $('input[value="Female"]').removeAttr("checked");
        }else if (('Female'.localeCompare(data[item]))==0){
          $('input[value="Female"]').attr("checked","true");
          $('input[value="Male"]').removeAttr("checked");
        }
        break;
      default:
        $("."+item).val(data[item]);
    }
  }
})
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/doctors/set_doctor.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=tblpatient&id='+localData;
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['tblpatient']){
      alert_success(res['msg'], function (rs) {
      	sessionStorage.removeItem('patient');
        window.location.href ='manage-patient.php';
      });
    }else{
      alert_error(res['msg']);
    }
  });
});
