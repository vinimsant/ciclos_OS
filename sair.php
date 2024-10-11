<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['nome'])){
    session_destroy();
    die(header("Location: login.php"));
}


?>