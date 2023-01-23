<?php
    // session_start();
    // session_unset();
    // session_destroy();

    setcookie("userck", $lid, time() - 86400,'/');

    echo "<script type='text/javascript'>location.href='index.php';</script>";
    exit();
