<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "viewtblpatient":
  //http://localhost:8080/hospitalAPI/doctors/get_doctors.php?event=viewpatient&page=0&records=5&id=4
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
	        $mang['patient']=$usertemp;
	    }
	    $usertemp=array();
	    $temp=array();
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
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "searchpatient":
  //http://localhost:8080/hospitalAPI/doctors/get_doctors.php?event=searchpatient&page=0&records=5&searchdata=97
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $sdata=$_POST['searchdata'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%' limit $page, $records"); 
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
    case "appointment":
  //http://localhost:8080/hospitalAPI/doctors/get_doctors.php?event=appointment&page=0&records=5&id=7
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
        $id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT users.fullName as pname,appointment.*  FROM appointment join doctors on doctors.id=appointment.doctorId join users on users.id=appointment.userId WHERE appointment.doctorId=$id limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp['id']=$row['id'];
	        $usertemp['pname']=$row['pname'];
	        $usertemp['doctorSpecialization']=$row['doctorSpecialization'];
	        $usertemp['consultancyFees']=$row['consultancyFees'];
	        $usertemp['appointmentDate']=$row['appointmentDate'];
	        $usertemp['appointmentTime']=$row['appointmentTime'];
			$usertemp['postingDate']=$row['postingDate'];
	        if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
			{
				$usertemp['action']="Active";
			}
			if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
			{
				$usertemp['action']="Cancel by Patient";
			}

			if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
			{
				$usertemp['action']="Cancel by you";
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
  //http://localhost:8080/myProject/hms1/doctor/manage-patient.php
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
        $id=$_POST['id'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT tblpatient.id as id ,`PatientName`, `PatientContno`, `PatientGender`, tblpatient.`CreationDate`, tblpatient.`UpdationDate` FROM `tblpatient` JOIN doctors ON doctors.id=tblpatient.Docid WHERE doctors.id=$id limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp['id']=$row['id'];
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=$row['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['CreationDate']=$row['CreationDate'];
	        $usertemp['UpdationDate']=$row['UpdationDate'];
			$mang[$i]=$usertemp;
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `tblpatient` JOIN doctors ON doctors.id=tblpatient.Docid WHERE doctors.id=$id");
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