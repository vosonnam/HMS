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
  var localIp = $('.msgerror').data('uip');
  var uname=$('.username').val();
  var upass=$('.password').val();
  var dataSend={
    event:'login',
    username:uname,
    password:upass,
    uip:localIp
  }
  queryDataPostJSon("../API/user/accout.php",dataSend,function (res) {
    if(res['login']==1){
      localStorage.setItem("email",uname);
      localStorage.setItem("username",res.items.username);
      localStorage.setItem("id",res.items.id);
      window.location.href ='dashboard.php';
    }else{
      $('.msgerror').text(res['msg']);
    }
  })
});