<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include("../connectdb.php");

$uid = $_COOKIE["userck"];

$approver_UID = $_POST["approver_UID"];
$s_date = $_POST["s_date"];
$e_date = $_POST["e_date"];
$que_desc = $_POST["que_desc"];

// echo $uid;
// echo $approver_UID;
// echo $s_date;
// echo $e_date;
// echo $que_desc;

$fromselect = "SELECT tool_all_ID, quantity FROM tool_cart
    WHERE UID = '$uid'
    AND cart_status_ID = 2";

$resfs = $conn->query($fromselect);

// $countitem = mysqli_num_rows($resfs);

// echo $countitem;
// while ($row = mysqli_fetch_array($resfs)) {
//     echo "ALL : " . print_r($row) . "</br>";
//     echo $row["tool_all_ID"] . "</br>";
// }

$insertque = "INSERT INTO queue_table
    (que_owner_UID, approver_UID, s_date, e_date, que_desc, queue_status)
    VALUES ('$uid', '$approver_UID', '$s_date', '$e_date', '$que_desc', 1)";

$resinsertque = $conn->query($insertque);

if ($resinsertque) {

    $selque = "SELECT * FROM queue_table 
        WHERE que_owner_UID = '$uid'
        AND s_date = '$s_date'
        AND e_date = '$e_date'";

    $resselque = $conn->query($selque);

    while ($selque = mysqli_fetch_array($resselque)) {
        $qid = $selque["que_ID"];
    }

    if ($resselque) {

        while ($row = mysqli_fetch_array($resfs)) {

            $toolidall = $row["tool_all_ID"];
            $quantity = $row["quantity"];

            for ($x = 1; $x <= $quantity; $x++) {
                $inserteer = "INSERT INTO ledger_table 
                    (que_ID, user_UID, tool_all_ID, tool_spec_ID, approver_UID, 
                    ledger_s_date, ledger_e_date, ledger_desc, queue_status) 
                    VALUES ('$qid', '$uid', '$toolidall', NULL, '$approver_UID', 
                    '$s_date', '$e_date', '$que_desc', 1)";

                $resinsertledger = $conn->query($inserteer);

                if ($resinsertledger) {

                    $quefetch = "SELECT * FROM queue_table
                        INNER JOIN user ON queue_table.approver_UID = user.UID
                        WHERE que_ID = '$qid'";
                    $resquefet = $conn->query($quefetch);

                    while ($querow = mysqli_fetch_array($resquefet)) {
                        $qid = $querow["que_ID"];
                        $aprmail = $querow["email"];
                        $queowner = $querow["que_owner_UID"];
                        $maildesc = $querow["que_desc"];
                    }

                    $mail = new PHPMailer(true);

                    try {
                        $mail->SMTPDebug = 2;
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'nattawutwextramailtest@gmail.com';
                        $mail->Password   = 'cnsvhhjdeoaonfjy';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = 587;

                        $mail->setFrom('nattawutwextramailtest@gmail.com', 'Nattawut');
                        $mail->addAddress($aprmail);

                        $mail->isHTML(true);
                        $mail->Subject = 'Request approval';
                        $mail->Body    = '<html>
                                <body>
                                    <a href="http://localhost/wextraproject/user/AllowTeacher.php?queid=' . $qid . '">
                                        CLICK
                                    </a>
                                </body>
                            </html>';
                        $mail->AltBody = 'http://localhost/wextraproject/user/AllowTeacher.php?queid=' . $qid . '';
                        $mail->send();
                        echo "Mail has been sent successfully!";

                        $emptycart = "DELETE FROM tool_cart WHERE UID = '$uid'";
                        $resemptyct = $conn->query($emptycart);

                        if ($resemptyct) {

                            echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
                        } else {

                            echo "Layer 4 : " . mysqli_error($conn);
                        }
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    // echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
                } else {

                    echo "Layer 3 : " . mysqli_error($conn);
                    // echo "<script type='text/javascript'>location.href='../user/Status.php';</script>";
                }
            }
        }
    } else {

        echo "Layer 2 : " . mysqli_error($conn);
        // echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
    }
} else {

    echo "Layer 1 : " . mysqli_error($conn);
    // echo "<script type='text/javascript'>location.href='../user/Alltools.php';</script>";
}
