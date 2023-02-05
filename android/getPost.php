<?php
include('../connectdb.php');
$news = $conn->query("SELECT post_title , post_time , post_desc ,post_pic_path FROM post_table");

$post_table = array();

while($new = mysqli_fetch_assoc($news)) {
$news1 = array();
$news1 ['post_title'] = $new;
$news1 ['post_time'] = $new;
$news1['post_desc']= $new;
$news1['post_pic_path'] = $new;

array_push($post_table,$new);

}
echo json_encode($post_table);

?>
