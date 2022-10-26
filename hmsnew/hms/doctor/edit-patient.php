<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Add Patient</title>
		
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
									<h1 class="mainTitle">Patient | Add Patient</h1>
								</div>
								<ol class="breadcrumb">
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Cập Nhật Bệnh Nhân</h5>
												</div>
												<div class="panel-body">
													<form role="form" name="" method="post">
														<div class="form-group">
															<label for="doctorname">
															Tên Bệnh Nhân
															</label>
															<input type="text" name="patname" class="form-control PatientName"  value="" required="true">
														</div>
														<div class="form-group">
															<label for="fess">
															Số Liên Lạc
															</label>
															<input type="text" name="patcontact" class="form-control PatientContno"  value="" required="true" maxlength="10" pattern="[0-9]+">
														</div>
														<div class="form-group">
															<label for="fess">
															 Email
															</label>
															<input type="email" id="patemail" name="patemail" class="form-control PatientEmail"  value="" readonly='true'>
															<span id="email-availability-status"></span>
														</div>
														<div class="form-group">
															<label class="control-label">Giới Tính: </label>
															<input type="radio" name="gender" id="PatientGender" value="Male" checked="true">Nam
															<input type="radio" name="gender" id="PatientGender" value="Female">Nữ
														</div>
														<div class="form-group">
															<label for="address">
															Địa Chỉ
															</label>
															<textarea name="pataddress" class="form-control PatientAdd" required="true"></textarea>
														</div>
														<div class="form-group">
															<label for="fess">
															Tuổi
															</label>
															<input type="text" name="patage" class="form-control PatientAge"  value="" required="true">
														</div>
														<div class="form-group">
															<label for="fess">
															Tiền Sử Bệnh
															</label>
															<textarea type="text" name="medhis" class="form-control PatientMedhis"  placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
														</div>	
														<div class="form-group">
															<label for="fess">
															Ngày Tạo
															</label>
															<input type="text" class="form-control CreationDate"  value="" readonly='true'>
														</div>
														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
														Cập Nhật
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
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
		<script type = "text/javascript" src="jsuser/edit-patient.js"></script>
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
