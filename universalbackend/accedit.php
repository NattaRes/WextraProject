<?php
include("connectdb.php");

$UID = $_POST['userID'];

$nename = $_POST['nametxt'];
$nepswd = $_POST['passtxt'];
$neemil = $_POST['emiltxt'];
$netele = $_POST['teletxt'];

if ((!empty($nename)) && ((!empty($nepswd))) && ((!empty($neemil))) && ((!empty($netele)))) {

    $userupdatesql = "UPDATE user SET username = $nename, password = $nepswd, email = $neemil, 
        telnum = $netele WHERE ID = $UID";

    $res = $conn->query($userupdatesql);

    if ($res) {

        $sccupdcon = "<script type='text/javascript'> alert('Account Update Successfully') </script>";
    } else {

        $errupdcon = "<script type='text/javascript'> alert('Error : Account Update Cancelled') </script>";
    }
} else {

    $misfrmcon = "<script type='text/javascript'> alert('Missing Form') </script>";
}
 
    // class Updateer {

    //     public $conndb;
    //     public $userid;
    //     public $name;
    //     public $password;
    //     public $email;
    //     public $telenum;

    //     public function __construct($conndb ,$uid ,$name, $password, $email, $telephonenumber) {

    //         $this->conndb = $conndb;
    //         $this->userid = $uid;
    //         $this->name = $name;
    //         $this->password = $password;
    //         $this->email = $email;
    //         $this->telenum = $telephonenumber;
    //     }

    //     public function __destruct() {
    //         $userupdatesql = "UPDATE user SET username = {$this->name}, password = {$this->password}, 
    //         email = {$this->email}, telnum = {$this->telenum} WHERE ID = {$this->userid}";

    //         $res = mysqli_query($this->conndb, $userupdatesql);
    //     }

    //     public function get_uid() {
    //         return $this->userid;
    //     }

    //     public function get_name() {
    //         return $this->name;
    //     }

    //     public function get_password() {
    //         return $this->password;
    //     }

    //     public function get_telenum() {
    //         return $this->telenum;
    //     }

    //     public function get_email() {
    //         return $this->email;
    //     }
    // }

    // $accprocess = new Updateer($conn, $UID, $nename, $nepswd, $neemil, $netele);
