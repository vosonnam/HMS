var currentPage=0;
function getSpecilizationId() {
  var data=sessionStorage.getItem("doctors");
  if(data==null){
    window.history.back();
  }
  return data;
}
var  localData=getSpecilizationId();
queryDataPostJSon("../../API/admin/select_admin.php",{event:'Doctorspecialization'},function (res) {
  var data=res['Doctorspecialization'];
  buildSelect($("select[name='docspecialization']"),data);
})
queryDataPostJSon("../../API/admin/select_admin.php",{event:'doctors',id:localData},function (res) {
  var data=res['doctors'];
  for( item in data){
    switch(item){
      case 'doctorName':
        $("h4."+item).text(data[item]+"'s Profile");
        $("input."+item).val(data[item]);
        break;
      case 'creationDate':
        $("p."+item).html("<b>Ngày Thêm: "+data[item]+"</b>");
        break;
      case 'updationDate':
        if(data[item]!=null){
          $("p."+item).removeAttr("hidden");
          $("p."+item).html("<b>Ngày Cập Nhật Lần Cuối: "+data[item]+"</b>");
        }
        break;
      default:
        $("."+item).val(data[item]);
    }
  }
})
$('form').submit(function(e){
  e.preventDefault();
  var url= "../../API/admin/set_admin.php";
  var dataSend='event=doctors&id=';
  dataSend+=localData+'&';
  dataSend+=$('form').serialize();
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['doctors']){
      alert_success(res['msg'], function (rs) {
        sessionStorage.removeItem('doctors');
        window.location.href ='manage-doctors.php';
      });
    }else{
      alert_error(res['msg']);
    }
  });
});
