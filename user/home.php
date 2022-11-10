<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Create Post UI with form plugins</title>

  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

  <script>
    function searcher() {
      document.getElementById("submit").click();
    }
  </script>

</head>

<body style=" margin-bottom: 10%;">
  <?php

  include("../connectdb.php");

  ?>
  <div style="margin-top: 15%;">
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <form action="Alltools.php" method="GET">
          <div class="search">
            <input class="search_input" type="text" name="sinput" placeholder="ค้นหาเครื่องมือ...">
            <input type="submit" id="submit" hidden />
            <a onclick="searcher()" class="search_icon"><i class="fa fa-search"></i></a>
          </div>
        </form>
      </div>
    </div>
    <div>
      <a href="Cart.php">
        <img src="../image/icon/shopping-cart (2).png" alt="" class="cart">
      </a>
    </div>
    <div>
      <h3 class="titlec">หมวดหมู่</h3>
    </div>
    <div class="row">
      <div class="column">
        <div class="one">
          <a href="Alltools.php" class="bt">
            <img src="../image/icon/photo-camera.png" alt="" class="iconimg">
            <h4 class="titlect">กล้องภาพนิ่ง</h4>
          </a>
        </div>
      </div>
      <!--
      <div class="column">
        <div class="two">
          <a href="Alltools.php" class="bt">
            <img src="../image/icon/video-camera.png" alt="" class="iconimg" style="margin-left: 30%;">
            <h4 class="titlect">กล้องวิดิทัศน์</h4>
          </a>
        </div>
      </div>
     -->
      <div class="column">
        <div class="three">
          <a href="Alltools.php" class="bt" style="margin-left: 0%;">
            <img src="../image/icon/eclipse.png" alt="" class="iconimg">
            <h4 class="titlect" style="margin-left: 45%;">ไฟ</h4>
          </a>
        </div>
      </div>
      <div class="column">
        <div class="four">
          <a href="Alltools.php" class="bt" style="margin-left: 2%;">
            <img src="../image/icon/microphone.png" alt="" class="iconimg">
            <h4 class="titlect" style="margin-left: 42%;">ไมค์</h4>
          </a>
        </div>
      </div>
      <div class="column">
        <div class="five">
          <a href="Alltools.php" class="bt" style="margin-left: 3%;">
            <img src="../image/icon/support.png" alt="" class="iconimg">
            <h4 class="titlect">อุปกรณ์เสริม</h4>
          </a>
        </div>
      </div>
    </div>
    <div style="margin-top: 20%;">
      <h3 class="titlec">เครื่องมือแนะนำ</h3>
    </div>
    <div class="container">
      <?php

      $poprecord = "SELECT * FROM tool_all_table
        INNER JOIN tool_type_table ON tool_type_table.tool_type = tool_all_table.tool_type
        INNER JOIN tool_brand_table ON tool_brand_table.tool_brand = tool_all_table.tool_brand
        ORDER BY RAND()
        LIMIT 4";
      $respoprc = $conn->query($poprecord);

      while ($rowpop = mysqli_fetch_array($respoprc)) {

      ?>
        <div class="box">
          <div class="image" >
            <img src="<?php echo $rowpop["tool_pic_path"]; ?>" style="width: 100%;height: 100%;  border-radius: 22px;">
          </div>
          <div class="name"><?php echo $rowpop["type_name"]; ?></div>
          <div style="color: #6e6e6e;"><?php echo $rowpop["brand_name"] . " " . $rowpop["tool_name"]; ?></div>
          <div style="color: #6e6e6e;"><?php echo $rowpop["tool_model"]; ?></div>

          <a href="Detailstools.php?toolidall=<?php echo $rowpop["tool_all_ID"]; ?>">
            <button class="onbutton" type="button">ดูเพิ่มเติม</button>
          </a>
        </div>
      <?php

      }

      ?>
      <!-- <div class="box">
        <div class="image">
          <img src="img2.jpeg" alt="">
        </div>
        <div class="name">ไมค์</div>
        <div style="color: #6e6e6e;">ชื่อ</div>
        <button class="onbutton" type="button">ดูเพิ่มเติม</button>
      </div>
      <div class="box">
        <div class="image">
          <img src="img3.jpeg" alt="">
        </div>
        <div class="name">ไฟ</div>
        <div style="color: #6e6e6e;">ชื่อ</div>
        <button class="onbutton" type="button">ดูเพิ่มเติม</button>
      </div>
      <div class="box">
        <div class="image">
          <img src="img3.jpeg" alt="">
        </div>
        <div class="name">ขากล้อง</div>
        <div style="color: #6e6e6e;">ชื่อ</div>
        <button class="onbutton" type="button">ดูเพิ่มเติม</button>
      </div> -->
    </div>

  </div>

</body>

</html>