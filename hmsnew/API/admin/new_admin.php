<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
    case "doctors":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/admin/new_admin.php?event=doctors&docspecialization=General+Physician&docname=Nam&docaddress=Thu+Duc&docfees=1200&doccontactno=0965276269&docemail=vsnam95@gmail.com&password=123456
        $docspecialization=$_POST['docspecialization'];
        $docname=$_POST['docname'];
        $docaddress=$_POST['docaddress'];
        $docfees=$_POST['docfees'];
        $doccontactno=$_POST['doccontactno'];
        $docemail=$_POST['docemail'];
        $password=$_POST['npass'];  
        $sql="insert into doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')";
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
    case "doctorSpecilization":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/admin/new_admin.php?event=doctorSpecilization&specilization=General+Physician
        $specilization=$_POST['specilization'];
        $sql="insert into doctorSpecilization(specilization) values('$specilization')";
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