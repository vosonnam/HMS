var localData=localStorage.getItem("id");
queryDataPostJSon("../API/user/select_user.php",{event:'Doctorspecialization'},function (res) {
  var data=res['Doctorspecialization'];
  buildSelect($("select[name='Doctorspecialization']"),data);
})
$("select[name='Doctorspecialization']").change(function (e) {
  e.preventDefault();
  queryDataPostJSon("../API/user/select_user.php",{event:'doctor', specilizationid: $(this).val()},function (res) {
    var data=res['doctor'];
    var html=$("select[name='doctor']").html();
    for (key in data){
        html+='<option value="'+data[key].id+'">'+data[key].doctorName+'</option>';
    }
    $("select[name='doctor']").html(html);
  })
})
$("select[name='doctor']").change(function (e) {
  e.preventDefault();
  queryDataPostJSon("../API/user/select_user.php",{event:'fees', doctor: $(this).val()},function (res) {
    var data=res['fees'];
    buildSelect($("select[name='fees']"),data);
  })
})
$('form').submit(function(e){
  e.preventDefault();
  var url= "../API/user/new_user.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=appointment&id='+localData;
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['appointment']){
      alert_success(res['msg'], function (rs) {
        window.location.href ='appointment-history.php';
      });
    }else{
      alert_error(res['msg']);
    }
  });
});