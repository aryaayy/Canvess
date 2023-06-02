<?php
	include('config.php');
    include('function.php');

    global $conn;

	$id_user = $_POST['id_user'];
	$id_mainchat = $_POST['id_mainchat'];
    $likeExist = checkLikesMain($id_user, $id_mainchat);
    
    if($likeExist == 0){
        $query = "INSERT INTO t_likesmain VALUES ('', $id_user, $id_mainchat)";
    }else{
        $query = "DELETE FROM t_likesmain WHERE id_user = $id_user AND id_mainchat = $id_mainchat";
    }
    $result = mysqli_query($conn, $query);
    $isSucceed = mysqli_affected_rows($conn);
    if ($isSucceed > 0) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }
?>