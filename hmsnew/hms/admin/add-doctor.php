<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Add Doctor</title>
		
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

		<!-- <script type = "text/javascript" src="jsuser/add-doctor.js"></script> -->
	</head>
	<body>
		<div id="app">		
			<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
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
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Thêm Bác Sĩ</h5>
												</div>
												<div class="panel-body">
									
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Chuyên Môn Bác Sĩ
															</label>
															<select name="docspecialization" class="form-control" required="true">
																<option value="null">Chọn Chuyên Môn Bác Sĩ</option>
															</select>
														</div>

														<div class="form-group">
															<label for="doctorname">
																 Tên Bác Sĩ
															</label>
															<input type="text" name="docname" class="form-control"  placeholder="Nhập Tên Bác Sĩ" required="true">
														</div>


														<div class="form-group">
															<label for="address">
																 Địa Chỉ Phòng Khám
															</label>
															<textarea name="docaddress" class="form-control"  placeholder="Nhập Địa Chỉ Phòng Khám" required="true"></textarea>
														</div>
															<div class="form-group">
															<label for="fess">
																 Phí Tư Vấn
															</label>
															<input type="text" name="docfees" class="form-control"  placeholder="Nhập Chi Phí Khám" required="true">
														</div>
	
														<div class="form-group">
															<label for="fess">
																Số Điện Thoại
															</label>
															<input type="text" name="doccontactno" class="form-control"  placeholder="Nhập Số Điện Thoại Bác Sĩ" required="true">
														</div>

														<div class="form-group">
															<label for="fess">
																 Email
															</label>
														<input type="email" id="docemail" name="docemail" class="form-control"  placeholder="Nhập Email Bác Sĩ" required="true" onBlur="checkemailAvailability()">
														<span id="email-availability-status"></span>
														</div>



														
														<div class="form-group">
															<label for="exampleInputPassword1">
																 Mật Khẩu
															</label>
															<input type="password" name="npass" class="form-control"  placeholder=" Mật Khẩu" required="required">
														</div>
														
														<div class="form-group">
															<label for="exampleInputPassword2">
																Nhập Lại Mật Khẩu
															</label>
															<input type="password" name="cfpass" class="form-control"  placeholder="Nhập Lại Mật Khẩu" required="required">
														</div>
														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
															Thêm
														</button>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									<div class="col-lg-12 col-md-12">
											<div class="panel panel-white">
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
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
		<script type = "text/javascript" src="jsuser/add-doctor.js"></script>
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
