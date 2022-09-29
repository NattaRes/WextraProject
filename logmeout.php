<?php
    session_start();
    session_destroy();
    setcookie("userck", $lid, time() - 86400,'/');
    echo "<script type='text/javascript'>location.href='index.html';</script>";
    exit();
?>