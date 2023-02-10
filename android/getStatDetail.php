<?php

include('../connectdb.php');
include('validate.php');

$qid = validate($_POST['queID']);
$uid = validate($_POST['UID']);

// $uid = "testuser";

$finaldata = array();

$usersql = "SELECT * FROM user WHERE UID = '$uid'";
$resusql = $conn->query($usersql);

while ($userdata = mysqli_fetch_array($resusql)) {

    $finaldata['UID'] = $userdata['UID'];
    $finaldata['username'] = $userdata['username'];
    $finaldata['email'] = $userdata['email'];
    $finaldata['phonenum'] = $userdata['phonenum'];
}

$ledgqid = "SELECT * FROM ledger_table WHERE que_ID = '$qid'";
$resldgq = $conn->query($ledgqid);

$dataset = array();
$chtlist = array();
$ubodate = array();

while ($data = mysqli_fetch_array($resldgq)) {

    $toolid = $data["tool_all_ID"];

    if (empty($ubodate)) {

        $sdate = $data["ledger_s_date"];
        $edate = $data["ledger_e_date"];
        $ubodate[] = array(
            "sdate" => $sdate,
            "edate" => $edate
        );
    }

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
        $chtlist[] = $toolid;
    }
}

$finaldata["sdate"] = $sdate;
$finaldata["edate"] = $edate;
$finaldata["list"] = $toolist;

echo json_encode($finaldata);
