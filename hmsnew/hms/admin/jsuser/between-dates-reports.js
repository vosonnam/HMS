$('form').submit(function(e){
  	e.preventDefault();
  	var dataSend=$('form').serializeArray();
  	var fromdate=$("#fromdate").val();
  	var todate=$("#todate").val();
  	sessionStorage.setItem("reportsfromdate",fromdate);
  	sessionStorage.setItem("reportstodate",todate);
  	window.location.href ='betweendates-detailsreports.php';
});