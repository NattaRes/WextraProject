<?php
include('../connectdb.php');
include('validate.php');

$uid = validate($_POST['UID']);
$stmt = $conn->query("SELECT * FROM ledger_table WHERE user_UID = '$uid'");

$queue_table['data'] = array();

while($newstmt = mysqli_fetch_array($stmt)) {
    $stmt1 = array();
   
    $stmt1['queue_status']=$newstmt;
    $stmt1['Ledger_num']=$newstmt;
    $stmt1['tool_all_ID']=$newstmt;
    $stmt1['tool_spec_ID']=$newstmt;
    $stmt1['approver_UID']=$newstmt;
    $stmt1['ledger_s_date']=$newstmt;
    $stmt1['ledger_e_date']=$newstmt;
    $stmt1['ledger_desc']=$newstmt;

   
    $stmt1['que_ID']=$newstmt;
    array_push($queue_table['data'],$newstmt);

}

echo json_encode($queue_table);
// while ( ) {
    
//     
    
//     }
    
?>
