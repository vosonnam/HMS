var currentPage=0;
var localData=localStorage.getItem("id");
function loadData(page,record) { 
    var url="../API/user/get_user.php"; 
    var dataSend={
      event:'appointment',
      page:page,
      records:record,
      id:localData
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
    html+='<tr data-idappointment="{val}">'.replace("{val}",item['id']);
    html+="<td class='center'>{val}</td>".replace("{val}",row);
    for(key in item){
      switch(key) {
        case 'id':
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
      html+='  <a href="#" class="btn btn-transparent btn-xs tooltips btn_cancel" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>';
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
$(".tb_data").on('click', '.btn_cancel', function(e){
  e.preventDefault();
  var row=$(this).parents('tr')[0];
  var cell=$(row).data('idappointment');
  queryDataPostJSon('../API/user/set_user.php',{event:'appointment',id:cell},function (res) {
    if(res['appointment']){
      alert_success(res['msg']);
      loadData(currentPage,5);
    }else{
      alert_error(res['msg']);
    }
  })
});
