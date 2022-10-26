var dataSend={
  event:'appointment',
  page:0,
  records:5,
  id:7
}
var url="/myProject/API/user/get_user.php";
var table={
  className:"tableAppointment",
  showData:function (data) {
    var strHtml="";
    var items=data['items'];
    for (stt in items){
      strHtml+="<tr>";
      var item=items[stt];
      for(key in item){
        // strHtml+="<td>"+item[key]+"</td>";
        switch(key) {
          case 'id':
              strHtml+="<td class='center'>{val}</td>".replace("{val}",item[key]);
            break;
          case 'appointmentDate':
              strHtml+="<td>{val}</td>".replace("{val}",item['appointmentDate']+item['appointmentTime']);
            break;
          case 'appointmentTime':
            break;
          case 'docname':
              strHtml+="<td class='hidden-xs'>{val}</td>".replace("{val}",item[key]);
            break;
          case 'action':
              strHtml+="<td>{val}</td>".replace("{val}",item[key]);
            break;
          default:
            strHtml+="<td>{val}</td>".replace("{val}",item[key]);
        }
      }
      if(("Active".localeCompare(item['action']))==0){
        strHtml+="<td><a class='btn btn-transparent btn-xs tooltips btncancel' onClick='cancel()' title='Cancel Appointment' tooltip-placement='top' tooltip='Remove'>Cancel</a></td>";
        // strHtml+='<td class="click_sua_admin"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> View </button></td>';
      }
      strHtml+='</tr>';
    }
    $("."+this.className).html(strHtml);
  }

}
queryDataPostJSon(url,dataSend,function (res) {
  table.showData(res);
});
$(".tableAppointment").on('click', '.btncancel', function(e){
  e.preventDefault();
  console.log("Đã nhấn Cancel");
  var row=$(this).parents('tr')[0];
  var cell=$('>td',row)[0].innerText;
  var dataSend={
    event:'appointment',
    id:cell
  }
  var url="/myProject/API/user/set_user.php";
  queryDataPostJSon(url,dataSend,function (res) {
    console.log(res['msg']);
  });
});