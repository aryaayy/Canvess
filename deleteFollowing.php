<?php
    session_start();
    include('function.php');

    $id_follower = $_SESSION['session_id_user'];
    $id_followed = $_GET['id_followed'];
    $valid = checkIdFollow($id_follower, $id_followed, 1);
    if($valid){
        $isSucceed = deleteFollow($id_follower, $id_followed);
        if($isSucceed > 0){

            header('Location: followingList.php');
        }else{
            echo "<script>
            Error occured
            </script>";
        }
    }else{
        echo "<script>
        alert('You do not have the permission');
        document.location.href = 'followingList.php';
        </script>";
    }
?>