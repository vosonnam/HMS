<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {    
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
  //http://localhost:8080/myProject/API/doctors/select_doctors.php?event=checkemail&email=a%40GMAIL.COM
	    $email=$_POST["email"];
	    $sql=mysqli_query($conn,"SELECT PatientEmail FROM tblpatient WHERE PatientEmail='$email'"); 
	    $row=mysqli_num_rows($sql);
	    if($row>0)
		{
			$jsonData[$event]=0;
			$jsonData['html']= "<span style='color:red'> Email này đã tồn tại .</span><script>$('#submit').prop('disabled',true);</script>";
		} else{
			$jsonData[$event]=1;
			$jsonData['html']="<span style='color:green'> Email khả dụng .</span><script>$('#submit').prop('disabled',false);</script>";
		}
	    // $jsonData =$mang;
	    echo json_encode($jsonData);
	    // echo $jsonData;
		// mysqli_close($conn);
		break;
	case "tblpatient":
  //http://localhost:8080/hospitalAPI/doctors/select_doctors.php?event=tblpatient&page=0&records=5&editid=4
		$mang=array();
	    $id=$_POST['id'];
	    $sql=mysqli_query($conn,"SELECT * from tblpatient where ID='$id'"); 
	    while ($row=mysqli_fetch_array($sql)){
	        $usertemp['PatientName']=$row['PatientName'];
	        $usertemp['PatientContno']=$row['PatientContno'];
	        $usertemp['PatientGender']=$row['PatientGender'];
	        $usertemp['PatientEmail']=$row['PatientEmail'];
	        $usertemp['PatientAdd']=$row['PatientAdd'];
	        $usertemp['PatientAge']=$row['PatientAge'];
	        $usertemp['PatientMedhis']=$row['PatientMedhis'];
	        $usertemp['CreationDate']=$row['CreationDate'];
			$jsonData[$event]=$usertemp;
	    }
	    // $jsonData =$mang;
	    echo json_encode($jsonData);
	    // echo $jsonData;
		// mysqli_close($conn);
		break;
	default:
      # code...
      break;
}
mysqli_close($conn);
?>