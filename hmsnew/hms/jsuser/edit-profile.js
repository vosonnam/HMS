var currentPage=0;
var localData=localStorage.getItem("id");
queryDataPostJSon("../API/user/accout.php",{event:'getprofile',id:localData},function (res) {
  var data=res['getprofile'];
  for( item in data){
    switch(item){
      case 'fullName':
        $("h4."+item).text(data[item]+"'s Profile");
        $("input."+item).val(data[item]);
        break;
      case 'regDate':
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
  var url= "/myProject/API/user/accout.php";
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
