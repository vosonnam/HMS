function showData (data) {
  var html="";
  var item=data['dashboard'];
  for(key in item){
    var val=$("."+key).text();
    $("."+key).text(val+item[key]);
  }
}
queryDataPostJSon("../../API/admin/select_admin.php",{event:'dashboard'},function (res) {
  showData(res);
});
