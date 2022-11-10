<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Edit Post UI with form plugins</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="ctools.css">

</head>

<body>

  <?php

  include("../connectdb.php");

  $url = $_SERVER['REQUEST_URI'];

  // echo $url;

  $partscrap = parse_url($url);

  parse_str($partscrap['query'], $parts);

  $postID = $parts['postid'];

  $tablequery = "SELECT * FROM post_table 
    INNER JOIN user ON post_table.UID = user.UID
    WHERE post_ID = '$postID'";

  $res = $conn->query($tablequery);

  while ($row = mysqli_fetch_array($res)) {
    $title = $row["post_title"];
    $date = $row["post_time"];
    $desc = $row["post_desc"];
    $pic_path = $row["post_pic_path"];
    $uid = $row["UID"];
    $username = $row["username"];
  }

  ?>

  <!-- Edit Post -->
  <div style="margin-top: 10%;">
    <div>
      <div class="mb-4">
        <h1 style="font-size: 30px; margin-left:10%;">
          แก้ไขโพสต์
        </h1>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
      <a href="Post.php?sfi=all&sinput=" >
            <i class='fa fa-times' style="float:right; font-size:30px; margin-top:0%;">
            </i>
            </a>  
      <form method="POST" action="../adminbackend/editpost.php?poid=<?php echo $postID; ?>" enctype="multipart/form-data">
          <!-- Text Input -->
          <div style="float: left ; width:50%; margin-bottom:2%;">
            <label style="font-size:18px;">
              หัวข้อ
            </label>
            <input class="block mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:90%;" type="text" name="pti" id="pti" placeholder="เพิ่มหัวข้อ" value="<?php echo $title; ?>" />
          </div>
          <div style="width:50%; ">
            <label style="font-size:18px; ">
              วันที่
            </label>
            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:40%;" type="date" name="pdt" id="pdt" placeholder="เพิ่มชื่อ" value="<?php echo $date; ?>" />
          </div>
          <!-- Image -->
          <div class='file-input'>
            <label style="margin-top:2%; font-size:18px;">เลือกรูปภาพ: </label>
            <input type='file' name="picupload" style="margin-top:2%;">
          </div>

          <!-- Description -->
          <div class="mt-4">
            <label style="font-size:18px;">
              รายละเอียด
            </label>
            <textarea name="description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="400"><?php echo $desc; ?></textarea>
          </div>

          <div class="flex items-center justify-start mt-4 gap-x-2">
            <button type="submit" style="width:150px;
              height:40px;
              border:none;
              font-size: 20px;
              border-radius:5px;
              margin-left:85%;
              background: #015C92;              
              color:#fff;
              cursor:pointer;">
              ยืนยัน
            </button>
          </div>
        </form>
     
      </div>
    </div>
  </div>

</body>

</html>