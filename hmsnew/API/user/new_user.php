<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "appointment":
        $msg="msg";
    // http://localhost:8080/myProject/API/user/new_user.php?event=appointment&Doctorspecialization=Demo+test&doctor=7&fees=200&appdate=2021-06-30&apptime=5%3A15+PM
		$specilization=$_POST['Doctorspecialization'];
        $doctorid=$_POST['doctor'];
        $userid=$_POST['id'];
        $fees=$_POST['fees'];
        $appdate=$_POST['appdate'];
        $time=$_POST['apptime'];
        $userstatus=1;
        $docstatus=1;  
    	$sql="INSERT into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')";
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
	default:
        # code...
        break;
}
mysqli_close($conn);
?>