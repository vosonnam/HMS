var currentPage=0;
function getContactusId() {
  var data=sessionStorage.getItem("contactus");
  if(data==null){
    window.history.back();
  }
  return data;
}
var  localData=getContactusId();
function showData (data) {
  var html="";
  var item=data['contactus'];
  for(key in item){
    switch(key) {
      case 'fullname':
          html+='<tr>';
          html+='  <th>Tên</th>';
          html+='  <td>{val}</td>'.replace("{val}",item[key]);
          html+='</tr>';
        break;
      case 'email':
          html+='<tr>';
          html+='  <th>Email</th>';
          html+='  <td>{val}</td>'.replace("{val}",item[key]);
          html+='</tr>';
        break;
      case 'contactno':
          html+='<tr>';
          html+='  <th>Số Liên Lạc</th>';
          html+='  <td>{val}</td>'.replace("{val}",item[key]);
          html+='</tr>';
        break;
      case 'message':
          html+='<tr>';
          html+='  <th>Ý Kiến</th>';
          html+='  <td>{val}</td>'.replace("{val}",item[key]);
          html+='</tr>';
        break;
      case 'AdminRemark':
          if(item[key]==null){
            html+='<form name="query" method="post">'
            html+='  <tr>'
            html+='    <th>Admin Phản Hồi</th>'
            html+='    <td><textarea name="adminremark" class="form-control adminremark" required="true"  id="update"></textarea></td>'
            html+='  </tr>'
            html+='  <tr>'
            html+='      <td>&nbsp;</td>'
            html+='      <td>'  
            html+='        <button type="submit" class="btn btn-primary pull-left update" name="update">'
            html+='        Cập Nhật <i class="fa fa-arrow-circle-right"></i>'
            html+='        </button>'
            html+='    </td>'
            html+='  </tr>'
            html+='</form>'             
          }else{
            html+='<tr>';
            html+='  <th>AdminRemark</th>';
            html+='  <td>{val}</td>'.replace("{val}",item[key]);
            html+='</tr>';
            html+='<tr>';
            html+='  <th>Ngày Cập Nhật Cuối</th>';
            html+='  <td>{val}</td>'.replace("{val}",item['LastupdationDate']);
            html+='</tr>'; 
          }
        break;
      default:
    }
  }
  $(".tb_data").html(html);
}
queryDataPostJSon("../../API/admin/select_admin.php",{event:'contactus',id:localData},function (res) {
  showData(res);
});
$(".tb_data").on('click','.update',function (e){
  e.preventDefault();
  var url= "../../API/admin/set_admin.php";
  var val=$("#update").val();
  var dataSend={
    event:'tblcontactus',
    id:localData,
    adminremark:val
  }
  queryDataPostJSon(url,dataSend,function (res) {
    if(res['tblcontactus']){
      alert_success(res['msg'], function (rs) {
        window.location.href ='query-details.php';
      });
    }else{
      alert_error(res['msg']);
    }
  });
})
