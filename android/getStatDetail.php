<?php

include('../connectdb.php');
include('validate.php');

$qid = validate($_POST['queID']);
$uid = validate($_POST['UID']);

// $uid = "testuser";
// $qid = "66";

$finaldata = array();

$usersql = "SELECT * FROM user WHERE UID = '$uid'";
$resusql = $conn->query($usersql);

while ($userdata = mysqli_fetch_array($resusql)) {

    $finaldata['UID'] = $userdata['UID'];
    $finaldata['username'] = $userdata['username'];
    $finaldata['email'] = $userdata['email'];
    $finaldata['phonenum'] = $userdata['phonenum'];
}

$quedet = "SELECT * FROM queue_table WHERE que_ID = '$qid'";
$resqdt = $conn->query($quedet);

while ($qrow = mysqli_fetch_array($resqdt)) {

    $finaldata["sdate"] = $qrow["s_date"];
    $finaldata["edate"] = $qrow["e_date"];
    $finaldata["que_desc"] = $qrow["que_desc"];
    $finaldata["queue_status"] = $qrow["queue_status"];
}

$ledgqid = "SELECT * FROM ledger_table WHERE que_ID = '$qid'";
$resldgq = $conn->query($ledgqid);

$dataset = array();
$chtlist = array();

while ($data = mysqli_fetch_array($resldgq)) {

    $toolid = $data["tool_all_ID"];

    if (!in_array($toolid, $chtlist)) {

        $tcntr = "SELECT * FROM ledger_table WHERE que_ID = '$qid'";
        $restc = $conn->query($tcntr);
        $tcoun = mysqli_num_rows($restc);

        $gtdata = "SELECT * FROM tool_all_table 
            INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
            WHERE tool_all_ID = '$toolid'";
        $resgtd = $conn->query($gtdata);

        while ($rowgtd = mysqli_fetch_array($resgtd)) {
            $tooldet = $rowgtd["tool_name"] . " " . $rowgtd["brand_name"] . " " . $rowgtd["tool_model"];
        }

        $dataset[] = array(
            "toolid" => $toolid,
            "name" => $tooldet,
            "quantity" => $tcoun
        );
        $chtlist[] = $dataset;
    }
}

$finaldata["list"] = $chtlist;

echo json_encode($finaldata);
