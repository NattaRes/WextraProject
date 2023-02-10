<?php
include('../connectdb.php');
include('validate.php');

$uid = validate($_POST['UID']);

$stmt = $conn->query("SELECT * FROM queue_table WHERE que_owner_UID = '$uid'");

$queue_table['data'] = array();

while($newstmt = mysqli_fetch_array($stmt)) {
    $stmt1 = array();

    $stmt1['que_desc'] = $newstmt['que_desc'];
    $stmt1['s_date'] = $newstmt['s_date'];
    $stmt1['e_date'] = $newstmt['e_date'];
    $stmt1['queue_status'] = $newstmt['queue_status'];
    $stmt1['que_ID'] = $newstmt['que_ID'];

    array_push($queue_table['data'],$stmt1);

}

echo json_encode($queue_table);

?>
