<?php

// define("HOST", "localhost:3307");
// define("USER", "root@");
// define("PASS", "");
// define("DBNM", "wextra");

// class ConnectDatabaseClass {

//     private $host = "localhost:3307";
//     private $user = "root@";
//     private $pass = "";
//     private $dbnm = "wextra";

//     // public function __construct($host, $user, $pass, $dbnm)
//     // {
//     //     $conn = mysqli_connect($host, $user, $pass, $dbnm);

//     //     if (mysqli_connect_error()) {
//     //         echo "SQL connect error : " . mysqli_connect_error();
//     //     } else {
//     //         // echo "Connected";
//     //     }

//     //     return $this->conn = $conn;
//     // }

//     protected function connecteer() {
//         $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbnm);

//         return $this->conn = $conn;
//     }
// }

$host = "localhost:3307";
$user = "root@";
$pass = "";
$dbnm = "wextra";
$conn = mysqli_connect($host, $user, $pass, $dbnm);
if (mysqli_connect_error()) {
    echo "SQL condition 1 connect error : " . mysqli_connect_error();
} else {
    // echo "Connected";
}
