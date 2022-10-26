<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {    
    case "fees":
  //http://localhost:8080/hospitalAPI/user/select_user.php?event=fees&doctor=9
	    $mang=array();
	    $doctor=$_POST['doctor'];
	    $sql=mysqli_query($conn,"select docFees from doctors where id='$doctor'"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $mang[$i]=$row['docFees'];
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "doctor":
  //http://localhost:8080/hospitalAPI/user/select_user.php?event=doctor&specilizationid=Dermatologist
	    $mang=array();
	    $specilizationid=$_POST['specilizationid'];
	    $sql=mysqli_query($conn,"select doctorName,id from doctors where specilization='$specilizationid'"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp['id']=$row['id'];
	    	$usertemp['doctorName']=$row['doctorName'];
	        $mang[$i]=$usertemp;
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;    
    case "Doctorspecialization":
  //http://localhost:8080/hospitalAPI/user/select_user.php?event=Doctorspecialization
	    $mang=array();
	    $sql=mysqli_query($conn,"select * from doctorspecilization"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $mang[$i]=$row['specilization'];
	    }
	    $jsonData[$event] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	default:
      # code...
      break;
}
mysqli_close($conn);
?>