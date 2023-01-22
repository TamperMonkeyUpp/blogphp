<?php
    require "libs/session.php";
    require "libs/function.php";


    $id = $_GET["id"];

    
    if(deleteComment($id)){
        $_SESSION['message'] = "Comment Deleted";
        $_SESSION['type'] = "danger";
        
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }else {
        echo "Error";
    }
    
   
?>