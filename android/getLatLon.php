<?php
include('../connectdb.php');
include('validate.php');

$cuid = validate($_POST['UID']);

// username, email, tel, lat, lon, tool list

$queuser = "SELECT * FROM queue_table WHERE queue_status = 6 AND que_owner_UID != '$cuid'";
$resqu = $conn->query($queuser);

$uar = array();
$finarr = array();

while ($qrow = mysqli_fetch_array($resqu)) {

    $uidcon = $qrow["que_owner_UID"];
    // $uidcon = "testuser";

    if (!in_array($uidcon, $uar)) {

        // push
        $uar[] = $uidcon;

        $getuser = "SELECT * FROM user WHERE UID = '$uidcon'";
        $resgetu = $conn->query($getuser);

        while ($userow = mysqli_fetch_array($resgetu)) {

            // push
            $uname = $userow["username"];
            $email = $userow["email"];
            $phone = $userow["phonenum"];
            $uclat = $userow["act_la"];
            $uclon = $userow["act_lo"];
        }

        $getleduser = "SELECT * FROM ledger_table 
            WHERE user_UID = '$uidcon' 
            AND queue_status = 6";
        $resgetlu = $conn->query($getleduser);

        // push
        $ctluser = array();
        $chkdate = false;

        while ($rowtl = mysqli_fetch_array($resgetlu)) {

            $toolid = $rowtl["tool_all_ID"];
            $valf = false;

            if (!empty($ctluser)) {

                foreach ($ctluser as $arr) {

                    if (in_array($toolid, $arr)) {

                        $valf = true;
                        break;
                    }
                }
            }

            if (!$chkdate) {

                $sdate = $rowtl["ledger_s_date"];
                $edate = $rowtl["ledger_e_date"];

                $chkdate = true;
            }

            if (!$valf) {

                $countcurt = "SELECT * FROM ledger_table
                    WHERE user_UID = '$uidcon'
                    AND queue_status = 6
                    AND tool_all_ID = '$toolid'";
                $rescct = $conn->query($countcurt);
                $tcount = mysqli_num_rows($rescct);

                $gtdata = "SELECT * FROM tool_all_table 
                INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
                WHERE tool_all_ID = '$toolid'";
                $resgtd = $conn->query($gtdata);

                while ($rowgtd = mysqli_fetch_array($resgtd)) {
                    $tooldet = $rowgtd["tool_name"] . " " . $rowgtd["brand_name"] . " " . $rowgtd["tool_model"];
                }

                $ctluser[] = array(
                    "toolid" => $toolid,
                    "name" => $tooldet,
                    "quantity" => $tcount
                );
            }
        }

        $finarr[] = array(
            "UID" => $uidcon,
            "username" => $uname,
            "email" => $email,
            "phone" => $phone,
            "lat" => $uclat,
            "lon" => $uclon,
            "sdate" => $sdate,
            "edate" => $edate,
            "list" => $ctluser
        );
    }
}

// $strSQL = $conn->query("SELECT uniqueId, latitude, longitude, dateCreated , Name FROM realtime");
// $arrRows = array();

// while($arr = mysqli_fetch_assoc($strSQL)) {
// $arrRows[] = array(
//     "uniqueId" => $arr["uniqueId"],
//     "latitude" => $arr["latitude"],
//     "longitude" => $arr["longitude"],
//     "dateCreated" => $arr["dateCreated"],
//     "Name" => $arr["Name"]

// );
// // $arryItem = array();
// // $arryItem["uniqueId"] = $arr;
// // $arryItem["latitude"] = $arr;
// // $arryItem["longitude"] = $arr;
// // $arryItem["dateCreated"] = $arr;
// // array_push($arrRows,$arr);
// }

echo json_encode($finarr);
