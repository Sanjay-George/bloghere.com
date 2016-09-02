<?php
    $link = mysqli_connect("localhost", "root", "", "bloghere");
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }
    session_start();
    

    echo $_POST['blogger_id'];

    if (array_key_exists('blog_id',$_POST) && array_key_exists('blogger_id',$_POST) && $_POST['like'] == 1){
        
        $query = "INSERT INTO `likes` (`blog_id`, `liker_id`) VALUES ('".$_POST['blog_id']."', '".$_POST['blogger_id']."') ";
        
        mysqli_query($link, $query);
    }
    else{
        $query = "DELETE FROM `likes` WHERE liker_id = '".$_POST['blogger_id']."' AND blog_id = '".$_POST['blog_id']."' ";
        mysqli_query($link, $query);
    }

?>