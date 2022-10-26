<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "checkemail":
  //http://localhost:8080/hospitalAPI/admin/select_admin.php?event=Doctorspecialization
	    
		$email= $_POST["email"];

		$sql =mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
		$rows=mysqli_num_rows($sql);
		if($rows>0)
		{
			$jsonData[$event] =0;
			$jsonData['html']="<span style='color:red'> Email này đã tồn tại .</span><script>$('#submit').prop('disabled',true);</script>";
		} else{

			$jsonData[$event] =1;
			$jsonData['html']= "<span style='color:green'> Email khả dụng .</span><script>$('#submit').prop('disabled',false);</script>";
		}

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "iduser":
		$msg="msg";
	 //http://localhost:8080/myProject/API/user/accout.php?event=iduser&id=Sarita+pandey&email=test%40gmail.com
		$name=$_POST['fullname'];
		$email=$_POST['email'];
        $sql=mysqli_query($conn,"select id from  users where fullName='$name' and email='$email'");
		$num=mysqli_fetch_array($sql);
		if($num>0)
		{
			$jsonData[$event]=1;
			$jsonData['msg']='';
		}
		else
		{
			$jsonData[$event]=0;
			$jsonData['msg']='Invalid details. Please try with valid details';
		}
		echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "newuser":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/user/accout.php?event=newuser&full_name=xcvxc&address=cxvxc&city=xvc&gender=female&email=vsnam95%40gmail.com&password=123456&password_again=123456
	 	$fname=$_POST['full_name'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$gender=$_POST['gender'];
		$email=$_POST['email'];
		$password=$_POST['password'];
        $sql="INSERT into users(fullname,address,city,gender,email,password) values('$fname','$address','$city','$gender','$email','$password')";
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
	case "resetpassword":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/user/accout.php?event=resetpassword&fullname=Sarita+pandey&email=test@gmail.com&password=654321
		$name=$_POST['fullname'];
		$email=$_POST['email'];
		$newpassword=$_POST['password'];
		$sql=mysqli_query($conn,"SELECT id from  users where fullName='$name' and email='$email'");
		$row=mysqli_num_rows($sql);
		if($row>0){
			$query="update users set password='$newpassword' where fullName='$name' and email='$email'";
			if (mysqli_query($conn, $query)===true){
				$jsonData[$event]=1;
				$jsonData[$msg]="Thao tác thành công!";
			}else{
				$jsonData[$event]=0;
				$jsonData[$msg]="Không thể thực hiện thao tác";
			}
		} else {
			$jsonData[$event]=0;
			$jsonData[$msg]='Thông tin email hoặc tên không trùng khớp';
		}
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "editemail":
		$msg="msg";
	 //http://localhost:8080/hospitalAPI/user/accout.php?event=editemail&id=2&email=test1%40gmail.com
	 	$id=$_POST['id'];
		$email=$_POST['email'];
        $sql="Update users set email='$email' where id='$id'";
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
	case "getprofile":
	 //http://localhost:8080/hospitalAPI/user/accout.php?event=getprofile&id=2
	 	$id=$_POST['id'];
        $sql=mysqli_query($conn,"select * from users where id='$id'");
		while ($rows=mysqli_fetch_array($sql)){
			$usertemp['fullName']=$rows['fullName'];
			$usertemp['regDate']=$rows['regDate'];
			$usertemp['updationDate']=$rows['updationDate'];
			$usertemp['address']=$rows['address'];
			$usertemp['city']=$rows['city'];
			$usertemp['gender']=$rows['gender'];
			$usertemp['email']=$rows['email'];
			$jsonData[$event]=$usertemp;
		} 
        echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "logout":
	 //http://localhost:8080/hospitalAPI/user/accout.php?event=logout&id=2
	 	$id=$_POST['id'];
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ldate=date( 'd-m-Y h:i:s A', time () );
        $sql="UPDATE userlog  SET logout = '$ldate' WHERE uid = '$id' ORDER BY id DESC LIMIT 1";
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
	 //http://localhost:8080/hospitalAPI/user/accout.php?fname=Sarita+pandey&address=New+Delhi+India&city=Delhi&gender=female&event=editprofile&id=2
	//http://localhost:8080/hospitalAPI/user/accout.php?fname=Sarita+pandey&address=HCM&city=Delhi&gender=female&event=editprofile&id=2
	 	$id=$_POST['id'];
		$fname=$_POST['fname'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$gender=$_POST['gender'];
        $sql="Update users set fullName='$fname',address='$address',city='$city',gender='$gender' where id='$id'";
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
	 //http://localhost:8080/myProject/API/user/accout.php?event=login&username=test%40gmail.com&password=Test%40123&uip=%3A%3A1
		$username=$_POST['username'];
		$password=$_POST['password'];
		$uip=$_POST['uip'];
        $sql=mysqli_query($conn,"SELECT * FROM users WHERE email='$username' and password='$password'"); 
        $rows=mysqli_fetch_array($sql);
		if($rows>0){
			$usertemp['id']=$rows['id'];
			$usertemp['username']=$rows['fullName'];
			$usertemp['email']=$rows['email'];
			$jsonData[$event] =1;
			$jsonData['items'] =$usertemp;
			$status=1;
			$query="INSERT into userlog(uid,username,userip,status) values('".$rows['id']."','$username','$uip','$status')";
			if(mysqli_query($conn,$query)===true){
				$jsonData['userlog']=1;
			}else{
				$jsonData['userlog']=0;
			}
			echo json_encode($jsonData);
		}else
		{
			$status=0;
			$jsonData[$event] =0;
			$jsonData['msg']="Thông tin tên hoặc mật khẩu không trùng khớp!!";
			$query="INSERT into userlog(username,userip,status) values('$username','$uip','$status')";
			if(mysqli_query($conn,$query)===true){
				$jsonData['userlog']=1;
			}else{
				$jsonData['userlog']=0;
			}
			echo json_encode($jsonData);
		}
		// mysqli_close($conn);
		break;
	 case "changepassword":
	 //http://localhost:8080/myProject/API/user/accout.php?oldpass=Test%40123&newpass=1&cfpass=1&event=changepassword&id=2
		date_default_timezone_set('Asia/Ho_Chi_Minh');// change according timezone
		$currentTime = date( 'Y-m-d h:i:s', time () );
		$id=$_POST['id'];
		$oldpass=$_POST['oldpass'];
		$newpass=$_POST['newpass'];
		$sql=mysqli_query($conn,"SELECT `password` FROM  users where `password`='$oldpass' && id='$id'");
		$num=mysqli_fetch_array($sql);
		if($num>0)
		{
			$query="UPDATE users set `password`='$newpass', updationDate='$currentTime' where id='$id'";
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
		// mysqli_close($conn);
		break;
		
	default:
	    # code...
	    break;
    }
mysqli_close($conn);
?>