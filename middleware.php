<?php
session_start();
function authentication(){
    if(isset( $_SESSION['admin_logged_in'] ) !== true){
        $_SESSION['message']='You are not an admin!';
        header('location:../index.php');
        exit;
    }
   
}


authentication(); 