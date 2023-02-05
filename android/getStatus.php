<?php
include('connectdb.php');
include('validate.php');

$uid = validate($_POST['UID']);
$stmt = $conn->query("SELECT * FROM queue_table WHERE que_owner_UID = '$uid'");

$queue_table['data'] = array();

while($newstmt = mysqli_fetch_array($stmt)) {
    $stmt1 = array();

    $stmt1['que_desc']=$newstmt;
    $stmt1['s_date']=$newstmt;
    $stmt1['e_date']=$newstmt;
    $stmt1['queue_status']=$newstmt;
    $stmt1['que_ID']=$newstmt;
    array_push($queue_table['data'],$newstmt);

}

echo json_encode($queue_table);
// while ( ) {
    
//     
    
//     }
    
?>
