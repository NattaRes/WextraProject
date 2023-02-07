<?php

include("../connectdb.php");
include("validate.php");

$uid = validate($_POST['UID']);

// $uid = "testuser";

$usersql = "SELECT * FROM user WHERE UID = '$uid'";
$resusql = $conn->query($usersql);

$finaldata = array();

while ($userdata = mysqli_fetch_array($resusql)) {

    $finaldata['UID'] = $userdata['UID'];
    $finaldata['username'] = $userdata['username'];
    $finaldata['email'] = $userdata['email'];
    $finaldata['phonenum'] = $userdata['phonenum'];
}

$usertoolsql = "SELECT * FROM ledger_table
    WHERE user_UID = '$uid'
    AND queue_status = 6";
$resutlsql = $conn->query($usertoolsql);

$toolist = array();
$chtlist = array();

while ($trow = mysqli_fetch_array($resutlsql)) {

    $curtool = $trow["tool_all_ID"];

    if (!in_array($curtool, $chtlist)) {

        $countcurt = "SELECT * FROM ledger_table
            WHERE user_UID = '$uid'
            AND queue_status = 6
            AND tool_all_ID = '$curtool'";
        $rescct = $conn->query($countcurt);
        $tcount = mysqli_num_rows($rescct);

        $gtdata = "SELECT * FROM tool_all_table 
            INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
            WHERE tool_all_ID = '$curtool'";
        $resgtd = $conn->query($gtdata);

        while ($rowgtd = mysqli_fetch_array($resgtd)) {
            $tooldet = $rowgtd["tool_name"] . " " . $rowgtd["brand_name"] . " " . $rowgtd["tool_model"];
        }

        $toolist[] = array(
            "toolid" => $curtool,
            "name" => $tooldet
        );
        $chtlist[] = $curtool;
    }
}

$finaldata["list"] = $toolist;

echo json_encode($finaldata);
