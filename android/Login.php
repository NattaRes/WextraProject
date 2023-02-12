<?php
// Check if email and password are set
if(isset($_POST['UID']) && isset($_POST['password'])){
    // Include the necessary files
    include("../connectdb.php");
    include("validate.php");
    // Call validate, pass form data as parameter and store the returned value
    $uid = validate($_POST['UID']);
    $password = validate($_POST['password']);
    // Create the SQL query string
    $sql = "SELECT * FROM `user` 
        INNER JOIN faculty_table ON user.faculty = faculty_table.faculty
        INNER JOIN level_table ON user.level = level_table.level
        WHERE UID ='$uid' and password='" . hash("sha256", $password) . "' ";
    // Execute the query
    $responce = array();
    $responce['data'] = array();
    $result = $conn->query($sql);
    // If number of rows returned is greater than 0 (that is, if the record is found), we'll print "success", otherwise "failure"
    // $user_table = array();
        
    if($result->num_rows > 0){

        $row = mysqli_fetch_assoc($result);
        $ds['UID'] =$row['UID'];
        $ds['username'] =$row['username'];
        $ds['email'] =$row['email'];
        $ds['phonenum'] =$row['phonenum'];
        $ds["faculty_name"] =$row["faculty_name"];
        $ds["level_name"] =$row["level_name"];
        array_push($responce['data'] ,$ds);
        $responce['status'] ="success";
        echo json_encode($responce);
        

    } else{
        // If no record is found, print "failure"
        $responce['status'] ="error";
        echo json_encode($responce);
    }
  

}
?>