<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {    
    case "dashboard":
  //http://localhost:8080/myProject/API/admin/select_admin.php?event=contactus&id=1
	    $mang=array();
	    $sql=mysqli_query($conn,"SELECT COUNT(*) as total FROM users ");
	    $row=mysqli_fetch_array($sql);
	    $mang['users'] =(int)$row['total'];
	    $sql=mysqli_query($conn,"SELECT COUNT(*) as total FROM doctors ");
	    $row=mysqli_fetch_array($sql);
	    $mang['doctors'] =(int)$row['total'];
	    $sql=mysqli_query($conn,"SELECT COUNT(*) as total FROM appointment");
	    $row=mysqli_fetch_array($sql);
	    $mang['appointment'] =(int)$row['total'];
	    $sql=mysqli_query($conn,"SELECT COUNT(*) as total FROM tblpatient ");
	    $row=mysqli_fetch_array($sql);
	    $mang['tblpatient'] =(int)$row['total'];
	    $sql=mysqli_query($conn,"SELECT COUNT(*) as total FROM tblcontactus where  IsRead is NULL ");
	    $row=mysqli_fetch_array($sql);
	    $mang['tblcontactus0'] =(int)$row['total'];
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "contactus":
  //http://localhost:8080/myProject/API/admin/select_admin.php?event=contactus&id=1
	    $mang=array();
	    $id= $_POST["id"];
	    $sql=mysqli_query($conn,"SELECT * from tblcontactus where id='$id'"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['fullname']=$row['fullname'];
	        $usertemp['email']=$row['email'];
	        $usertemp['contactno']=['contactno'];
	        $usertemp['message']=$row['message'];
	        $usertemp['AdminRemark']=$row['AdminRemark'];
	        $usertemp['LastupdationDate']=$row['LastupdationDate'];
	        $mang=$usertemp;
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "doctors":
  //http://localhost:8080/hospitalAPI/admin/select_admin.php?event=Doctorspecialization
	    $mang=array();
	    $id= $_POST["id"];
	    $sql=mysqli_query($conn,"SELECT * FROM `doctors` WHERE `id`='$id'"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['specilization']=$row['specilization'];
	        $usertemp['doctorName']=$row['doctorName'];
	        $usertemp['address']=$row['address'];
	        $usertemp['docFees']=$row['docFees'];
	        $usertemp['contactno']=$row['contactno'];
	        $usertemp['docEmail']=$row['docEmail'];
	        $usertemp['creationDate']=$row['creationDate'];
	        $usertemp['updationDate']=$row['updationDate'];
	        $mang=$usertemp;
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "Doctorspecialization":
  //http://localhost:8080/hospitalAPI/admin/select_admin.php?event=Doctorspecialization
	    $mang=array();
	    $sql=mysqli_query($conn,"SELECT * from doctorspecilization"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $mang[$i]=$row['specilization'];
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "checkemail":
  //http://localhost:8080/hospitalAPI/admin/select_admin.php?event=Doctorspecialization
	    $email= $_POST["emailid"];
		$sql =mysqli_query($conn,"SELECT docEmail FROM doctors WHERE docEmail='$email'");
		$rows=mysqli_num_rows($sql);
		if($rows>0)
		{
			$jsonData[$event] =0;
			$jsonData['html']= "<span style='color:red'> Email này đã tồn tại .</span><script>$('#submit').prop('disabled',true);</script>";
		} else{
			$jsonData[$event] =1;
			$jsonData['html']="<span style='color:green'> Email khả dụng .</span><script>$('#submit').prop('disabled',false);</script>";
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
