<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	 case "login":
	 //http://localhost:8080/hospitalAPI/admin/accout.php?event=login&username=admin&password=Test@12345
		$username=$_POST['username'];
		$password=$_POST['password'];
        $sql=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' and password='$password'"); 
        $rows=mysqli_fetch_array($sql);
		if($rows>0){
			$usertemp['id']=$rows['id'];
			$usertemp['username']=$rows['username'];
			$jsonData[$event] =1;
		
			$jsonData['items'] =$usertemp;
		
			echo json_encode($jsonData);
		}else
		{
			$jsonData[$event] =0;
			$jsonData['msg']="Không tồn tại tên hoặc mật khẩu";
		
			echo json_encode($jsonData);
		}
		mysqli_close($conn);
		break;
	 case "changepassword":
	 //http://localhost:8080/myProject/API/admin/accout.php?oldpass=Test%4012345&newpass=123456&cfpass=123456&event=changepassword&username=admin
		date_default_timezone_set('Asia/Ho_Chi_Minh');// change according timezone
		$currentTime = date( 'd-m-Y h:i:s A', time () );
		$username=$_POST['username'];
		$oldpass=$_POST['oldpass'];
		$newpass=$_POST['newpass'];
		$sql=mysqli_query($conn,"SELECT password FROM  admin where password='$oldpass' && username='$username'");
		$num=mysqli_fetch_array($sql);
		if($num>0)
		{
		 	$query="update admin set password='$newpass', updationDate='$currentTime' where username='$username'";
		 	if(mysqli_query($conn,$query)===true){
		 		$jsonData[$event]=1;
				$jsonData['msg']="Thao tác thành công!";
		 	}else{
		 		$jsonData[$event]=0;
				$jsonData['msg']="Không thể thực hiện thao tác";
		 	}
		 	
		}
		else
		{
			$jsonData[$event]=0;
			$jsonData['msg']="Không trùng khớp mật khẩu cũ!!";
		}
		echo json_encode($jsonData);
		mysqli_close($conn);
		break;
		
	default:
	    # code...
	    break;
    }//hahaquen dau dc ddos
?>