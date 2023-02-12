<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
  <link rel="stylesheet" href="Dashborad.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <?php

  include("../connectdb.php");

  ?>


  <div class="home-content" style="margin-top: 10%;">
    <div class="overview-boxes">
      <div class="box">
        <div class="right-side">
          <div class="box-topic">ยอดรวมการจอง</div>
          <?php

          $totalque = "SELECT * FROM queue_table";
          $resttque = $conn->query($totalque);
          $ttqcount = mysqli_num_rows($resttque);

          ?>
          <div class="number"><?php echo number_format($ttqcount, 0, '.', ','); ?></div>
        </div>
      </div>
      <div class="box">
        <div class="right-side">
          <div class="box-topic">ยอดรวมการยืม-คืน</div>
          <?php

          $totalbort = "SELECT * FROM queue_table WHERE queue_status = 6 OR queue_status = 7";
          $resttbt = $conn->query($totalbort);
          $ttbtcount = mysqli_num_rows($resttbt);

          ?>
          <div class="number"><?php echo number_format($ttbtcount, 0, '.', ','); ?></div>
        </div>
      </div>
      <div class="box">
        <div class="right-side">
          <div class="box-topic">ยอดรวมอุปกรณ์</div>
          <?php

          $totaltool = "SELECT * FROM tool_specific_table";
          $restotool = $conn->query($totaltool);
          $counttool = mysqli_num_rows($restotool);

          ?>
          <div class="number"><?php echo number_format($counttool, 0, '.', ','); ?></div>
        </div>
      </div>
      <div class="box">
        <select id="toolstatslc" onchange="toolstatch(this.value)">
          <option value="usablet" selected>ว่าง</option>
          <option value="usingto">อยู่ระหว่างการใช้งาน</option>
          <option value="defectt">ชำรุด</option>
          <option value="lostool">สูญหาย</option>
        </select>

        <!-- USABLE -->
        <div class="right-side" id="usablet">
          <div class="box-topic">ว่าง</div>
          <?php

          $slcusabletool = "SELECT * FROM tool_specific_table WHERE tool_status = 1";
          $resusable = $conn->query($slcusabletool);
          $countusable = mysqli_num_rows($resusable);

          ?>
          <div class="number"><?php echo number_format($countusable, 0, '.', ','); ?></div>
        </div>

        <!-- IN USE -->
        <div class="right-side" style="display: none;" id="usingto">
          <div class="box-topic">กำลังใช้งาน</div>
          <?php

          $slcinusetool = "SELECT * FROM tool_specific_table WHERE tool_status = 2";
          $resinuse = $conn->query($slcinusetool);
          $countinuse = mysqli_num_rows($resinuse);

          ?>
          <div class="number"><?php echo number_format($countinuse, 0, '.', ','); ?></div>
        </div>

        <!-- DEFECTIVE -->
        <div class="right-side" style="display: none;" id="defectt">
          <div class="box-topic">ชำรุด</div>
          <?php

          $slcdefecttool = "SELECT * FROM tool_specific_table WHERE tool_status = 3";
          $resdefect = $conn->query($slcdefecttool);
          $countdefect = mysqli_num_rows($resdefect);

          ?>
          <div class="number"><?php echo number_format($countdefect, 0, '.', ','); ?></div>
        </div>

        <!-- LOST -->
        <div class="right-side" style="display: none;" id="lostool">
          <div class="box-topic">สูญหาย</div>
          <?php

          $slclosttool = "SELECT * FROM tool_specific_table WHERE tool_status = 4";
          $reslost = $conn->query($slclosttool);
          $countlost = mysqli_num_rows($reslost);

          ?>
          <div class="number"><?php echo number_format($countlost, 0, '.', ','); ?></div>
        </div>

      </div>
    </div>

    <div class="sales-boxes">
      <div class="recent-sales box">
        <div class="title">กราฟแท่ง</div>
        <div class="sales-details">
          <!--กราฟ-->
        </div>

      </div>
      <div class="top-sales box">
        <div class="title">แผนภูมิ</div>
        <!--แผนภูมิ-->
      </div>
    </div>
  </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }

    var toolstatselector = document.getElementById("toolstatslc");

    function toolstatch(slcvalue) {

      if (slcvalue === "usablet") {
        document.getElementById("usablet").style.display = "block";
        document.getElementById("usingto").style.display = "none";
        document.getElementById("defectt").style.display = "none";
        document.getElementById("lostool").style.display = "none";
      } else if (slcvalue === "usingto") {
        document.getElementById("usingto").style.display = "block";
        document.getElementById("usablet").style.display = "none";
        document.getElementById("defectt").style.display = "none";
        document.getElementById("lostool").style.display = "none";
      } else if (slcvalue === "defectt") {
        document.getElementById("defectt").style.display = "block";
        document.getElementById("usingto").style.display = "none";
        document.getElementById("usablet").style.display = "none";
        document.getElementById("lostool").style.display = "none";
      } else if (slcvalue === "lostool") {
        document.getElementById("lostool").style.display = "block";
        document.getElementById("usingto").style.display = "none";
        document.getElementById("defectt").style.display = "none";
        document.getElementById("usablet").style.display = "none";
      }
    }
  </script>

</body>

</html>