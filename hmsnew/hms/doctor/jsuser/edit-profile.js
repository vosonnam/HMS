var currentPage=0;
var localData=localStorage.getItem("id");
queryDataPostJSon("../../API/doctors/select_doctors.php",{event:'Doctorspecialization'},function (res) {
  var data=res['Doctorspecialization'];
  buildSelect($("select[name='docspecialization']"),data);
})
queryDataPostJSon("../../API/doctors/accout.php",{event:'getprofile',id:localData},function (res) {
  var data=res['getprofile'];
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
  var url= "../../API/doctors/accout.php";
  var dataSend=$('form').serialize();
  dataSend+='&event=editprofile&id='+localData;
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['editprofile']){
      alert_success(res['msg'], function (rs) {
        window.history.back();
      });
    }else{
      alert_error(res['msg']);
    }
  });
});
