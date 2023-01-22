<?php
    require "libs/session.php";
    require "libs/function.php";

    $id = $_GET["id"];
    
    if(deleteBlog($id)){
        $_SESSION['message'] = $id.' Blog Number Deleted';
        $_SESSION['type'] = "danger";
        
        header("Location: admin-blogs.php");
    }else {
        echo "hata";
    }
    
   
?>