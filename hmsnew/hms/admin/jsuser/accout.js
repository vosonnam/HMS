function queryDataPostJSon(url,dataSend,callback){
    
    $.ajax({
        type: 'POST',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
$('.dangnhap').click(function(e){
  e.preventDefault();
  var uname=$('.username').val();
  var upass=$('.password').val();
  var dataSend={
    event:'login',
    username:uname,
    password:upass
  }
  queryDataPostJSon("../../API/admin/accout.php",dataSend,function (res) {
    if(res['login']==1){
      localStorage.setItem("username",uname);
      localStorage.setItem("password",upass);
      window.location.href ='dashboard.php';
    }else{
      $('.msgerror').text(res['msg']);
    }
  })
});