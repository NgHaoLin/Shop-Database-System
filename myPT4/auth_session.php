<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        echo '<script type="text/javascript">';
        echo 'alert("Please login to continue.");'; 
        echo 'window.location.href = "login.php";';
        echo '</script>';
        exit();
    }
?>