<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
    case "users":
        $msg="msg";
        //INSERT INTO `users`(`fullName`, `address`, `city`, `gender`, `email`, `password`, ) VALUES ('Hoa','Viet Nam','Thu Duc','Be de','bedevn@gmail.com','1')
    // http://localhost:8080/hospitalAPI/admin/del_admin.php?event=users&id=14
        $id=$_POST['id'];  
        $sql="DELETE from users where id = '$id'";
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
    // http://localhost:8080/hospitalAPI/admin/del_admin.php?event=doctors&id=14
        $id=$_POST['id'];  
        $sql="DELETE from doctors where id = '$id'";
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
    // http://localhost:8080/hospitalAPI/admin/del_admin.php?event=doctorSpecilization&id=14
		$id=$_POST['id'];  
    	$sql="DELETE from doctorSpecilization where id = $id";
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