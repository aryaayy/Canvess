<?php
    session_start();
    include('function.php');

    $id_replychat = $_GET['id_replychat'];
    $isSucceed = deleteReply($id_replychat);
    if($isSucceed > 0){
        $type = $_GET['type'];
        if($type == 1){
            header('Location: profile.php');
        }elseif($type == 2){
            $id_mainchat = $_GET['id_mainchat'];
            header("Location: post.php?id_mainchat=$id_mainchat");
        }
    }else{
      echo "<script>
      Error occured
      </script>";
    }
?>