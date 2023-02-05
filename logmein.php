<?php
include("connectdb.php");

if ((!empty($lid)) && (!empty($pwd))) {
    $sqlquery = "SELECT * FROM user WHERE UID = '$lid' AND password = '$hashpwd'";
    // $result = mysqli_query($conn, $sqlquery);

    $result = $conn->query($sqlquery);

    $cnt = 0;

    // $cnt = 0;

    // while ($rs = mysqli_fetch_array($result)) {
    //     $cnt++;
    // }

    // if ($cnt == 1) {
    //     setcookie("userck", $lid, time()+86400, '/');
    //     header("Location: ", true, 301);
    // } else {
    //     header("Location: Login.html", true, 301);
    // }

    // while ($row = mysqli_fetch_array($result)) {
    //     echo $row['username']; // Print a single column data
    //     echo print_r($row);    // Print the entire row data
    // }

    // if ($result) {
    //     // echo "\n1111";
    //     // $rolefet = "SELECT role FROM user WHERE ID = '$lid'";
    //     while ($row = mysqli_fetch_array($result)) {
    //         // echo "\n1122";
    //         if ($row["role"] == "admin") {
    //             setcookie("userck", $lid, time() + 86400, '/');
    //             // echo "\nADMIN : " . $lid;
    //             echo "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";
    //             exit();
    //         } elseif ($row["role"] == "stuser") {
    //             setcookie("userck", $lid, time() + 86400, '/');
    //             // echo "\nUSER : " . $lid;
    //             echo "<script type='text/javascript'>location.href='user/menubarUser.html';</script>";
    //             exit();
    //         }
    //     }
    // }

    while ($row = mysqli_fetch_array($result)) {
        // echo "\n1122";
        if ($row["role"] == "1") {
            $roller = "admin";
        } else {
            $roller = "user";
        }
        $cnt++;
    }

    if ($cnt == 1) {
        if ($roller == "admin") {
            // session_start();
            // session_name("loginses");
            // setcookie(session_name(), session_id(), time() + 86400, '/');
            // $_SESSION["userck"] = $lid;

            setcookie("userck", $lid, time() + 86400, '/');
            // echo "\nADMIN : " . $lid;

            // setcookie("userck", $lid, time() + 86400, '/', 'digiproj.sut.ac.th');

            // if (isset($_COOKIE["userck"])) {

            //     echo "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";
            //     exit();
            // } else {

            //     echo "<script type='text/javascript'>alert('Login Error')</script>";
            //     // echo $_COOKIE["PHPSESSID"];
            // }

            // $shm_key = ftok(__FILE__, 't');
            // $shm_id = shm_attach($shm_key, 1024, 0666);
            // shm_put_var($shm_id, 1, $lid);

            // session_start();
            // $_SESSION["userck"] = $lid;
            // print_r($_SESSION);

            echo "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";
            exit();
        } else {
            // session_start();
            // session_name("loginses");
            // setcookie(session_name(), session_id(), time() + 86400, '/');
            // $_SESSION["userck"] = $lid;

            setcookie("userck", $lid, time() + 86400, '/');
            // echo "\nUSER : " . $lid;

            // if (isset($_COOKIE["userck"])) {

            //     echo "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";
            //     exit();
            // } else {

            //     echo "<script type='text/javascript'>alert('Login Error')</script>";
            //     // echo $_COOKIE["PHPSESSID"];
            // }

            // $shm_key = ftok(__FILE__, 't');
            // $shm_id = shm_attach($shm_key, 1024, 0666);
            // shm_put_var($shm_id, 1, $lid);

            // session_start();
            // $_SESSION["userck"] = $lid;
            // print_r($_SESSION);

            echo "<script type='text/javascript'>location.href='user/menubarUser.php';</script>";
            exit();
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid ID / Password.')</script>";
        exit();
    }
}
