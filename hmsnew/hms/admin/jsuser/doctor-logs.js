var currentPage=0;
function loadData(page,record) { 
    var url="../../API/admin/get_admin.php"; 
    var dataSend={
      event:'doctorslog',
      page:page,
      records:record
    }
    $(".tb_data").html("<img src='../../images/loading.gif' width='5px' height='5px'/>");
    queryDataPostJSon(url,dataSend,function (res) {
      $(".tb_data").html("");
      showData(res);
    });
}
function showData (data) {
  var html="";
  var rows=data['items'];
  for (row in rows){
    html+="<tr>";
    var item=rows[row];
    for(key in item){
      switch(key) {
        case 'id':
            html+="<td class='center'>{val}</td>".replace("{val}",item[key]);
          break;
        case 'uid':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        case 'username':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        default:
          html+="<td>{val}</td>".replace("{val}",item[key]);
      }
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