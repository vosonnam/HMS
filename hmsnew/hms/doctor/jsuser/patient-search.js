var currentPage=0;
var  searchdata="";
function loadData(page,record) {
    var url="../../API/doctors/get_doctors.php"; 
    var dataSend={
      event:'searchpatient',
      page:page,
      records:record,
      searchdata:searchdata
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
        case 'PatientName':
            html+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
          break;
        default:
          html+="<td>{val}</td>".replace("{val}",item[key]);
      }
    }
    html+='<td >';
    html+='  <a class="btn btn-transparent btn-xs tooltips btn_sua" tooltip-placement="top" tooltip="Remove"><i class="fa fa-edit"></i></a>';
    html+=' ||   <a class="btn btn-transparent btn-xs tooltips btn_view" tooltip-placement="top" tooltip="Remove"><i class="fa fa-eye"></i></a>';
    html+='</td>';
    html+='</tr>';
  }
  $(".tb_data").html(html);
  var totalPage=data['total']/5;
  buildSlidePage($('.ls_numberpage'),5,currentPage,totalPage);
}
// loadData(currentPage,5);
$(".ls_numberpage").on('click','button',function () {
    currentPage=$(this).val();
    loadData($(this).val(),5);
});
$(".tb_data").on('click', '.btn_view', function(e){
  e.preventDefault();
  var row=$(this).parents('tr')[0];
  var cell=$('>td',row)[0].innerText;
  sessionStorage.setItem("patient",cell);
  window.location.href ='view-patient.php';
});
$(".tb_data").on('click', '.btn_sua', function(e){
  e.preventDefault();
  var row=$(this).parents('tr')[0];
  var cell=$('>td',row)[0].innerText;
  sessionStorage.setItem("patient",cell);
  window.location.href ='edit-patient.php';
});
$('form').submit(function(e){
  e.preventDefault();
  searchdata=$('#searchdata').val();
  $('.resultSearch').removeAttr("hidden");
  $('.titleTable').text('Kết Quả Tìm Kiếm Từ Khoá "'+ searchdata +'"');
  loadData(currentPage,5);
});
