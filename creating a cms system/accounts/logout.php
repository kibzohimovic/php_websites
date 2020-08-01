<?php
session_start(); //you have to first start the session before destroying it

if(session_destroy()){
    header('Location:../index.php'); //where you will be redirected after logging out
}
?>