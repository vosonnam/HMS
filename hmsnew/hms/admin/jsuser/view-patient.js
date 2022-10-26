var currentPage=0;
function getPatientId() {
  data=sessionStorage.getItem("viewpatient");
  if(data==null){
    window.history.back();
  }
  return data;
}
var  searchdata=getPatientId();
function loadPatient() {
  var url="../../API/admin/get_admin.php"; 
  var dataSend={
    event:'viewpatient',
    page:0,
    records:5,
    id:searchdata
  }
  queryDataPostJSon(url,dataSend,function (res) {
    var infoPatient=res['patient'];
    for(item in infoPatient){
      $("."+item).text(infoPatient[item]);
    }
  });
}
loadPatient();
function loadData(page,record) {
    var url="../../API/admin/get_admin.php"; 
    var dataSend={
      event:'viewpatient',
      page:page,
      records:record,
      id:searchdata
    }
    $(".tb_data").html("<img src='../../images/loading.gif' width='5px' height='5px'/>");
    queryDataPostJSon(url,dataSend,function (res) {
      $(".tb_data").html("");
      showData(res);
    });
}
function showData (data) {
  var html="";
  var rows=data['medical'];
  for (row in rows){
    html+="<tr>";
    var item=rows[row];
    html+="<td>{val}</td>".replace("{val}",row);
    for(key in item){
          html+="<td>{val}</td>".replace("{val}",item[key]);
    }
    html+='</tr>';
  }
  $(".tb_data").html(html);
  var totalPage=data['total']/5;
  buildSlidePage($('.ls_numberpage'),5,currentPage,totalPage);
}
loadData(currentPage,5);
$(".ls_numberpage").on('click','button',function () {
    currentPage=$(this).val();
    loadData($(this).val(),5);
});
