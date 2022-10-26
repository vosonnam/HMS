var currentPage=0;
function loadData(page,record) { 
    var url="../../API/admin/get_admin.php"; 
    var dataSend={
      event:'appointment',
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
        case 'docname':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        case 'pname':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        case 'appointmentDate':
            html+="<td>{val}</td>".replace("{val}",item['appointmentDate']+"/"+item['appointmentTime']);
          break;
        case 'appointmentTime':
          break;
        default:
          html+="<td>{val}</td>".replace("{val}",item[key]);
      }
    }
    html+='<td >';
    if(('Active'.localeCompare(item['action']))==0){
      html+='  <div class="visible-md visible-lg hidden-sm hidden-xs">{val}</div>'.replace("{val}","No Action yet");
    }else{
      html+='  <div class="visible-md visible-lg hidden-sm hidden-xs">{val}</div>'.replace("{val}","Canceled");
    }
    html+='</td>';
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
