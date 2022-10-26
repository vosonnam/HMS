<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Manage Patients</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
    <div id="app">		
      <?php include('include/sidebar.php');?>
      <div class="app-content">
        <?php include('include/header.php');?>
        <div class="main-content" >
          <div class="wrap-content container" id="container">
          						<!-- start: PAGE TITLE -->
            <section id="page-title">
              <div class="row">
                <div class="col-sm-8">
                  <h1 class="mainTitle"></h1>
                </div>
                <ol class="breadcrumb">
                </ol>
              </div>
            </section>
            <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="panel panel-white">
                    <form method="post" name="submit">
                      <table class="table table-bordered table-hover data-tables">
                        <tr>
                          <th>Huyết Áp :</th>
                          <td>
                          <input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true"></td>
                        </tr>                          
                        <tr>
                          <th>Lượng Đường Trong Máu :</th>
                          <td>
                          <input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
                        </tr> 
                        <tr>
                          <th>Cân Nặng :</th>
                          <td>
                          <input name="weight" placeholder="Weight" class="form-control wd-450" required="true"></td>
                        </tr>
                        <tr>
                          <th>Thân Nhiệt :</th>
                          <td>
                          <input name="temp" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
                        </tr>

                        <tr>
                          <th>Ngày Khám :</th>
                          <td>
                          <textarea name="pres" placeholder="Medical Prescription" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
                        </tr>  
                      </table>
                      <p align="center">
                        <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                      </p>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery.js"></script>
    <script src="vendor/bootbox.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
    <script src="jsuser/main.js"></script>
    <script type = "text/javascript" src="jsuser/add-medical.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
