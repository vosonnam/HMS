<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "appointment":
        $msg="msg";
    // http://localhost:8080/hospitalAPI/user/set_user.php?&event=appointment&id=6
		$id=$_POST['id'];  
    	$sql="update appointment set userStatus='0' where id = $id";
        if (mysqli_query($conn, $sql)===true) {
            $res[$event] = 1;
            $res[$msg]="Thao tác thành công!";
        } else {
            $res[$event] = 0;
            $res[$msg]="Không thể thực hiện thao tác";
        }
        echo json_encode($res);
        // mysqli_close($conn);
        break;
	default:
        # code...
        break;
}
mysqli_close($conn);
?>