<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "isuser":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?event=resetpassword&contactno=965276269&email=vsnam95@gmail.com&password=654321
		$contactno=$_POST['contactno'];
		$email=$_POST['email'];
		$sql=mysqli_query($conn,"select id from  doctors where contactno='$contactno' and docEmail='$email'");
		$row=mysqli_num_rows($sql);
		if($row>0){
			$jsonData[$event]=1;
			$jsonData[$msg]='';
		} else {
			$jsonData[$event]=0;
			$jsonData[$msg]='Thông tin số điện thoại hoặc email không tồn tại';
		}
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "resetpassword":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?event=resetpassword&contactno=965276269&email=vsnam95@gmail.com&password=654321
		$contactno=$_POST['contactno'];
		$email=$_POST['email'];
		$newpassword=$_POST['password'];
		$sql=mysqli_query($conn,"select id from  doctors where contactno='$contactno' and docEmail='$email'");
		$row=mysqli_num_rows($sql);
		if($row>0){
			$query="UPDATE doctors set password='$newpassword' where contactno='$contactno' and docEmail='$email'";
			if (mysqli_query($conn, $query)===true){
				$jsonData[$event]=1;
				$jsonData[$msg]="Thao tác thành công!";
			}else{
				$jsonData[$event]=0;
				$jsonData[$msg]="Không thể thực hiện thao tác";
			}
		} else {
			$jsonData[$event]=0;
			$jsonData[$msg]='Thông tin số điện thoại hoặc email không trùng khớp';
		}
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "getprofile":
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?event=getprofile&id=7
	 	$id=$_POST['id'];
        $sql=mysqli_query($conn,"select * from doctors where id='$id'");
		while ($rows=mysqli_fetch_array($sql)){
			$usertemp['specilization']=$rows['specilization'];
			$usertemp['doctorName']=$rows['doctorName'];
			$usertemp['address']=$rows['address'];
			$usertemp['docFees']=$rows['docFees'];
			$usertemp['contactno']=$rows['contactno'];
			$usertemp['docEmail']=$rows['docEmail'];
			$usertemp['creationDate']=$rows['creationDate'];
			$usertemp['updationDate']=$rows['updationDate'];
			$jsonData[$event]=$usertemp;
		} 
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "logout":
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?event=logout&id=7
	 	$id=$_POST['id'];
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ldate=date( 'd-m-Y h:i:s A', time () );
        $sql="UPDATE doctorslog  SET logout = '$ldate' WHERE uid = '$id' ORDER BY id DESC LIMIT 1";
		if (mysqli_query($conn, $sql)===true) {
            $jsonData[$event] = 1;
        } else {
            $jsonData[$event] = 0;
        }
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "editprofile":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?Doctorspecialization=Demo+test&docname=abc+&clinicaddress=New+Delhi+India&docfees=200&doccontact=852888888&event=editprofile&id=7
	//http://localhost:8080/hospitalAPI/doctors/accout.php?Doctorspecialization=Demo+test&docname=abc+&clinicaddress=New+Delhi+India&docfees=200&doccontact=55&event=editprofile&id=7
	 	$id=$_POST['id'];
		$docspecialization=$_POST['docspecialization'];
		$docname=$_POST['docname'];
		$docaddress=$_POST['clinicaddress'];
		$docfees=$_POST['docfees'];
		$doccontactno=$_POST['doccontact'];
        $sql="UPDATE doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='$id'";
		if (mysqli_query($conn, $sql)===true) {
            $jsonData[$event] = 1;
            $jsonData[$msg]="Thao tác thành công!";
        } else {
            $jsonData[$event] = 0;
            $jsonData[$msg]="Không thể thực hiện thao tác";
        }
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	 case "login":
	 //http://localhost:8080/hospitalAPI/doctors/accout.php?event=login&username=test@demo.com&password=f925916e2754e5e03f75dd58a5733251&uip=
		$username=$_POST['username'];
		$password=$_POST['password'];
		$uip=$_POST['uip'];
        $sql=mysqli_query($conn,"SELECT * FROM doctors WHERE docEmail='$username' and password='$password'"); 
        $rows=mysqli_fetch_array($sql);
		if($rows>0){
			$usertemp['id']=$rows['id'];
			$usertemp['username']=$rows['doctorName'];
			$usertemp['email']=$rows['docEmail'];
			$jsonData[$event] =1;
			$jsonData['items'] =$usertemp;
			$status=1;
			$query="INSERT into doctorslog(uid,username,userip,status) values('".$rows['id']."','$username','$uip','$status')";
			if(mysqli_query($conn,$query)===true){
				$jsonData['doctorslog']=1;
			}else{
				$jsonData['doctorslog']=0;
			}
			echo json_encode($jsonData);
		}else{
			$jsonData[$event] =0;
			$jsonData['msg']="Thông tin tên hoặc mật khẩu không trùng khớp!!";
			$status=0;
			$query="INSERT into doctorslog(username,userip,status) values('$username','$uip','$status')";
			if(mysqli_query($conn,$query)===true){
				$jsonData['doctorslog']=1;
			}else{
				$jsonData['doctorslog']=0;
			}
			echo json_encode($jsonData);
		}
		
		// mysqli_close($conn);
		break;
	 case "changepassword":
	 //http://localhost:8080/myProject/API/doctors/accout.php?oldpass=Test%4012345&newpass=1&cfpass=1&event=changepassword&id=7
		date_default_timezone_set('Asia/Ho_Chi_Minh');// change according timezone
		$currentTime = date( 'Y-m-d h:i:s', time () );
		$id=$_POST['id'];
		$oldpass=$_POST['oldpass'];
		$newpass=$_POST['newpass'];
		$sql=mysqli_query($conn,"SELECT password FROM  doctors where password='$oldpass' && id='$id'");
		$num=mysqli_fetch_array($sql);
		$query="";
		if($num>0)
		{//2019-11-11 01:38:10
		 	$query="UPDATE `doctors` SET `password`='$newpass',`updationDate`='$currentTime' WHERE `id`='$id'";
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
			$jsonData['msg']="Mật khẩu cũ không trùng khớp !!";
		}
		echo json_encode($jsonData);
		// echo $query;
		// mysqli_close($conn);
		break;
		
	default:
	    # code...
	    break;
    }
mysqli_close($conn);
?>