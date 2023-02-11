<?php 

include('../connectdb.php');
include('validate.php');

$toolid = validate($_POST['toolid']);

$slctool = "SELECT * FROM tool_all_table
    INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
    INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
    WHERE tool_all_ID = '$toolid'";
$resslct = $conn->query($slctool);

$finaldata = array();

while ($trow = mysqli_fetch_array($resslct)) {

    $finaldata["tool_all_ID"] = $trow["tool_all_ID"];
    $finaldata["brand_name"] = $trow["brand_name"];
    $finaldata["tool_name"] = $trow["tool_name"];
    $finaldata["tool_model"] = $trow["tool_model"];
    $finaldata["type_name"] = $trow["type_name"];
    $finaldata["tool_desc"] = $trow["tool_desc"];
    $finaldata["tool_pic_path"] = $trow["tool_pic_path"];
}

echo json_encode($finaldata);

?>