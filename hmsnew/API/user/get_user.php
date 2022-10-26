<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "viewpatient":
  //http://localhost:8080/hospitalAPI/user/get_user.php?event=viewpatient&page=0&records=5&id=1
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"select * from tblpatient where ID='$id'"); 
	    while($row=mysqli_fetch_array($sql)){
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientEmail']=$row['PatientEmail'];
	        $usertemp['PatientContno']=['PatientContno'];
	        $usertemp['PatientAdd']=$row['PatientAdd'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['PatientAge']=$row['PatientAge'];
	        $usertemp['PatientMedhis']=$row['PatientMedhis'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $mang['patient']=$usertemp;
	    }
	    $usertemp=array();
	    $temp=array();
	    $sql=mysqli_query($conn,"select * from tblmedicalhistory  where PatientID='$id' limit $page, $records"); 
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
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "appointment":
  //http://localhost:8080/hospitalAPI/user/get_user.php?event=appointment&page=0&records=5&id=7
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
		$id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT doctors.doctorName as docname, appointment.*  FROM appointment join doctors on doctors.id=appointment.doctorId join users on users.id=appointment.userId WHERE appointment.userId=$id limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp['id']=$row['id'];
	        $usertemp['docname']=$row['docname'];
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
	            $usertemp['action']= "Cancel by You";
	        }else if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
	        {
	            $usertemp['action']= "Cancel by Doctor";
	        }else if(($row['userStatus']==0) && ($row['doctorStatus']==0))  
	        {
	            $usertemp['action']= "Canceled";
	        }
	        $mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM appointment WHERE appointment.userId=$id");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

    case "tblpatient":
  //http://localhost:8080/hospitalAPI/user/get_user.php?event=tblpatient&page=0&records=5&id=2
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
        $id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `PatientName`, `PatientContno`, `PatientGender`, `CreationDate`, tblpatient.`UpdationDate` FROM `tblpatient` JOIN users ON users.email=tblpatient.PatientEmail WHERE users.id=$id limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=$row['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $usertemp['UpdationDate']=$row['UpdationDate'];
			$mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `tblpatient` JOIN users ON users.email=tblpatient.PatientEmail WHERE users.id=$id");
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