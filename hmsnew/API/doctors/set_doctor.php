<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
    case "tblpatient":
        $msg="msg";
// http://localhost:8080/myProject/API/doctors/set_doctor.php?patname=Raghu+Yadav&patcontact=9797977979&patemail=raghu%40gmail.com&gender=Male&pataddress=ABC+Apartment+Mayur+Vihar+Ph-1+New+Delhi&patage=39&medhis=No&event=tblpatient&id=2
        $id=$_POST['id'];
        $patname=$_POST['patname'];
        $patcontact=$_POST['patcontact'];
        $patemail=$_POST['patemail'];
        $gender=$_POST['gender'];
        $pataddress=$_POST['pataddress'];
        $patage=$_POST['patage'];
        $medhis=$_POST['medhis'];  
        $sql="UPDATE tblpatient set PatientName='$patname',PatientContno='$patcontact',PatientEmail='$patemail',PatientGender='$gender',PatientAdd='$pataddress',PatientAge='$patage',PatientMedhis='$medhis' where ID='$id'";
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
	case "appointment":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/doctors/set_doctor.php?&event=appointment&id=3
		$id=$_POST['id'];  
    	$sql="UPDATE appointment set doctorStatus='0' where id = $id";
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