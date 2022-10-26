var currentPage=0;
function loadData(page,record) { 
    var url="../../API/admin/get_admin.php"; 
    var dataSend={
      event:'users',
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
        case 'fullName':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        default:
          html+="<td>{val}</td>".replace("{val}",item[key]);
      }
    }
    html+='<td >';
    html+='  <a class="btn btn-transparent btn-xs tooltips btn_xoa" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>';
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
$(".tb_data").on('click', '.btn_xoa', function(e){
  e.preventDefault();
  var row=$(this).parents('tr')[0];
  var cell=$('>td',row)[0].innerText;
  var dataSend={
    event:'users',
    id:cell
  }
  var url="../../API/admin/del_admin.php";
  bootbox.confirm("<h5>Bạn có chắc xóa thông tin người dùng "+$('>td',row)[1].innerText+" này không?</h5>",function(result){
    if(result==true){
      queryDataPostJSon(url,dataSend,function (res) {
        if(res['users']){
          alert_success(res['msg']);
          loadData(currentPage,5);
        }else{
          alert_error(res['msg']);
        }
      });
    }else{
    }
  });
});
