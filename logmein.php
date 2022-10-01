<?php
include("connectdb.php");

$lid = $_POST['lid'];
$pwd = $_POST['pwd'];

if ((!empty($lid)) && (!empty($pwd))) {
    $sqlquery = "SELECT * FROM user WHERE ID = '$lid' AND password = '$pwd'";
    // $result = mysqli_query($conn, $sqlquery);

    $result = $conn->query($sqlquery);

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

    if ($result) {
        // echo "\n1111";
        // $rolefet = "SELECT role FROM user WHERE ID = '$lid'";
        while ($row = mysqli_fetch_array($result)) {
            // echo "\n1122";
            if ($row["role"] == "admin") {
                setcookie("userck", $lid, time() + 86400, '/');
                // echo "\nADMIN : " . $lid;
                echo "<script type='text/javascript'>location.href='adminsite/menubar.html';</script>";
                exit();
            } elseif ($row["role"] == "stuser") {
                setcookie("userck", $lid, time() + 86400, '/');
                // echo "\nUSER : " . $lid;
                echo "<script type='text/javascript'>location.href='user/menubarUser.html';</script>";
                exit();
            }
        }
    }
}
