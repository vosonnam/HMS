var currentPage=0;
var  localData=localStorage.getItem("id");
function loadPatient() {
  var url="../API/user/get_user.php"; 
  var dataSend={
    event:'viewpatient',
    page:0,
    records:5,
    id:localData
  }
  queryDataPostJSon(url,dataSend,function (res) {
    var infoPatient=res.items.patient;
    for(item in infoPatient){
      $("."+item).text(infoPatient[item]);
    }
  });
}
loadPatient();
function loadData(page,record) {
    var url="../API/user/get_user.php"; 
    var dataSend={
      event:'viewpatient',
      page:page,
      records:record,
      id:localData
    }
    $(".tb_data").html("<img src='../images/loading.gif' width='5px' height='5px'/>");
    queryDataPostJSon(url,dataSend,function (res) {
      $(".tb_data").html("");
      showData(res);
    });
}
function showData (data) {
  var html="";
  var rows=data.items.medical;
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
