<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
    case "tblcontactus":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/admin/set_admin.php?adminremark=hoa+c%C3%A0+t%C3%ADm+l%C3%A0+b%C3%AA+%C4%91%C3%AA&event=tblcontactus&id=4
        
        $id=$_POST['id']; 
        $adminremark=$_POST['adminremark'];
        $isread=1;  
        $sql="UPDATE tblcontactus set  AdminRemark='$adminremark',IsRead='$isread' where id='$id'";
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
    case "doctors":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/admin/set_admin.php?id=22&Doctorspecialization=General+Physiciann&docname=Nam+be+de&clinicaddress=Thu+bo&docfees=1200&doccontact=0965276269&docemail=vsnam95@gmail.com&event=doctors
        $id=$_POST['id']; 
        $docspecialization=$_POST['docspecialization'];
        $docname=$_POST['docname'];
        $docaddress=$_POST['clinicaddress'];
        $docfees=$_POST['docfees'];
        $doccontactno=$_POST['doccontact'];
        $docemail=$_POST['docemail'];  
        $sql="UPDATE doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno',docEmail='$docemail' where id='$id'";
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
    case "doctorspecilization":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/admin/set_admin.php?id=22&Doctorspecialization=General+Physiciann&docname=Nam+be+de&clinicaddress=Thu+bo&docfees=1200&doccontact=0965276269&docemail=vsnam95@gmail.com&event=doctors
        $id=$_POST['id'];
        $specilization=$_POST['specilization']; 
        $sql="UPDATE  doctorSpecilization set specilization='$specilization' where id='$id'";
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