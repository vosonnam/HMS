<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "searchpatient":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=searchpatient&page=0&records=5&searchdata=97
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $sdata=$_POST['searchdata'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%' limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['ID']=$row['ID'];
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=$row['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $usertemp['UpdationDate']=$row['UpdationDate'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "viewpatient":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=viewpatient&page=0&records=5&id=1
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT * from tblpatient where ID='$id'"); 
	    while($row=mysqli_fetch_array($sql)){
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientEmail']=$row['PatientEmail'];
	        $usertemp['PatientContno']=['PatientContno'];
	        $usertemp['PatientAdd']=$row['PatientAdd'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['PatientAge']=$row['PatientAge'];
	        $usertemp['PatientMedhis']=$row['PatientMedhis'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $mang=$usertemp;
	    }
	    $temp=array();
	    $usertemp=array();
	    $sql=mysqli_query($conn,"SELECT * from tblmedicalhistory  where PatientID='$id' limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['BloodPressure']=$row['BloodPressure'];
	        $usertemp['Weight']=$row['Weight'];
	        $usertemp['BloodSugar']=['BloodSugar'];
	        $usertemp['Temperature']=$row['Temperature'];
	        $usertemp['MedicalPres']=$row['MedicalPres'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $temp[$i]=$usertemp;
	    }
	    $mang['medical']=$temp;
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total from tblmedicalhistory  where PatientID='$id'");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['medical'] =$temp;
	    $jsonData['patient'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "reports":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=reports&page=0&records=5&fromdate=2021-04-03&todate=2021-06-03
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $fdate=$_POST['fromdate'];
		$tdate=$_POST['todate'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT * from tblpatient where date(CreationDate) between '$fdate' and '$tdate' limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['ID']=$row['ID'];
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $usertemp['UpdationDate']=$row['UpdationDate'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total from tblpatient where date(CreationDate) between '$fdate' and '$tdate'");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "userlog":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=userlog&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status` FROM `userlog` WHERE 1 limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['uid']=$row['uid'];
	        $usertemp['username']=$row['username'];
	        $usertemp['userip']=$row['userip'];
	        $usertemp['loginTime']=$row['loginTime'];
	        $usertemp['logout']=$row['logout'];
	        // $usertemp['status']=$row['status'];
	        if($row['status']==1)
			{
				$usertemp['status']="Success";
			}
			else
			{
				$usertemp['status']="Failed";
			}
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `userlog`");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

	case "doctorslog":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=doctorslog&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status` FROM `doctorslog` WHERE 1 limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['uid']=$row['uid'];
	        $usertemp['username']=$row['username'];
	        $usertemp['userip']=$row['userip'];
	        $usertemp['loginTime']=$row['loginTime'];
	        $usertemp['logout']=$row['logout'];
	        // $usertemp['status']=$row['status'];
	        if($row['status']==1)
			{
				$usertemp['status']="Success";
			}
			else
			{
				$usertemp['status']="Failed";
			}
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `doctorslog`");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

  	case "tblcontactus0":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=tblcontactus0&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, `fullname`, `email`, `contactno`, `message` FROM `tblcontactus` WHERE `IsRead` is null limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['fullname']=$row['fullname'];
	        $usertemp['email']=$row['email'];
	        $usertemp['contactno']=$row['contactno'];
	        $usertemp['message']=$row['message'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `tblcontactus` WHERE `IsRead` is null");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

  	case "tblcontactus1":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=tblcontactus1&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, `fullname`, `email`, `contactno`, `message` FROM `tblcontactus` WHERE `IsRead`=1 limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['fullname']=$row['fullname'];
	        $usertemp['email']=$row['email'];
	        $usertemp['contactno']=$row['contactno'];
	        $usertemp['message']=$row['message'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `tblcontactus` WHERE `IsRead`=1");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

  	case "tblpatient":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=tblpatient&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `ID`, `PatientName`, `PatientContno`, `PatientGender`, `CreationDate`, `UpdationDate` FROM `tblpatient` WHERE 1 limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['ID']=$row['ID'];
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=$row['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $usertemp['UpdationDate']=$row['UpdationDate'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `tblpatient`");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

  	case "users":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=users&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, `fullName`, `address`, `city`, `gender`, `email`, `regDate`, `updationDate` FROM `users` limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['fullName']=$row['fullName'];
	        $usertemp['address']=$row['address'];
	        $usertemp['city']=$row['city'];
	        $usertemp['gender']=$row['gender'];
	        $usertemp['email']=$row['email'];
	        $usertemp['regDate']=$row['regDate'];
	        $usertemp['updationDate']=$row['updationDate'];
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `users`");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break; 	
		 
  	case "doctors":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=doctors&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
		$rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `doctors`");
	    $rowrs=mysqli_fetch_array($rs);
	    $coutn=(int)$rowrs['total'];

	    $sql=mysqli_query($conn,"SELECT * from doctors limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['id']=$row['id'];
	        $usertemp['specilization']=$row['specilization'];
	        $usertemp['doctorName']=$row['doctorName'];
	        // $usertemp['address']=$row['address'];
	        // $usertemp['docFees']=$row['docFees'];
	        // $usertemp['contactno']=$row['contactno'];
	        // $usertemp['docEmail']=$row['docEmail'];
	        $usertemp['creationDate']=$row['creationDate'];
	        // $usertemp['updationDate']=$row['updationDate'];
	        $mang[$i]=$usertemp;
	    }
	    $jsonData['total'] =$coutn;
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	
	case "appointment":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=appointment&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT doctors.doctorName as docname,users.fullName as pname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId join users on users.id=appointment.userId limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp['id']=$row['id'];
	        $usertemp['docname']=$row['docname'];
			$usertemp['pname']=$row['pname'];
	        $usertemp['doctorSpecialization']=$row['doctorSpecialization'];
	        $usertemp['consultancyFees']=$row['consultancyFees'];
	        $usertemp['appointmentDate']=$row['appointmentDate'];
	        $usertemp['appointmentTime']=$row['appointmentTime'];
			$usertemp['postingDate']=$row['postingDate'];
	        if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
	        {
	            $usertemp['action']="Active";
	        }else if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
	        {
	            $usertemp['action']= "Cancel by Patient";
	        }else if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
	        {
	            $usertemp['action']= "Cancel by Doctor";
	        }else if(($row['userStatus']==0) && ($row['doctorStatus']==0))  
	        {
	            $usertemp['action']= "Canceled";
	        }

	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total from appointment");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

	case "doctorspecilization":
  //http://localhost:8080/hospitalAPI/admin/get_admin.php?event=doctorspecilization&page=0&records=5
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT * FROM `doctorspecilization` limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
			$usertemp['id']=$row['id'];
	        $usertemp['specilization']=$row['specilization'];
	        $usertemp['creationDate']=$row['creationDate'];
	        $usertemp['updationDate']=$row['updationDate'];
			$mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `doctorspecilization`");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

	default:
      # code...
      break;
}
mysqli_close($conn);
?>