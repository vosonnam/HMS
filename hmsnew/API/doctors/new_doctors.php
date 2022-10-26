<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
    case "addpatient":
        $msg="msg";
    // http://localhost:8080/myProject/API/doctors/new_doctors.php?event=addpatient&patname=a&patcontact=1&patemail=a%40GMAIL.COM&gender=female&pataddress=a&patage=1&medhis=a
        $docid=$_POST['id'];
        $patname=$_POST['patname'];
        $patcontact=$_POST['patcontact'];
        $patemail=$_POST['patemail'];
        $gender=$_POST['gender'];
        $pataddress=$_POST['pataddress'];
        $patage=$_POST['patage'];
        $medhis=$_POST['medhis']; 
        $sql="INSERT into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')";
        if (mysqli_query($conn, $sql)===true) {
            $jsonData[$event] = 1;
            $jsonData[$msg]="Patient has been added.";
        } else {
            $jsonData[$event] = 0;
            $jsonData[$msg]="Không thể thực hiện thao tác";
        }
        // echo $sql;
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "medicalhistory":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/doctors/new_doctors.php?event=medicalhistory&viewid=4&bp=123&bs=123&weight=60&temp=37&pres=%23h2o%23no3%23h2so4
        $id=$_POST['id'];
        $bp=$_POST['bp'];
        $bs=$_POST['bs'];
        $weight=$_POST['weight'];
        $temp=$_POST['temp'];
        $pres=$_POST['pres']; 
        $sql="INSERT tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$id','$bp','$bs','$weight','$temp','$pres')";
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