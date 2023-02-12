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
      <div class="box" style="background:#92CEA8;">
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
      <div class="box" style="background:#FFBBDA;">
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
      <div class="box" style="background:#C0E4F6;">
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
   
      <div class="box" style="background:#E6BEAE;">
        
      <select id="toolstatslc" onchange="toolstatch(this.value)" style="width:100px ">
          <option value="usablet" selected>ว่าง</option>
          <option value="usingto">อยู่ระหว่างการใช้งาน</option>
          <option value="defectt">ชำรุด</option>
          <option value="lostool">สูญหาย</option>
        </select>
        <!-- USABLE -->
        <div class="right-side" id="usablet" style="margin-left:15%;">
          <div class="box-topic">ว่าง</div>
          <?php

          $slcusabletool = "SELECT * FROM tool_specific_table WHERE tool_status = 1";
          $resusable = $conn->query($slcusabletool);
          $countusable = mysqli_num_rows($resusable);

          ?>
          <div class="number"><?php echo number_format($countusable, 0, '.', ','); ?></div>
        </div>

        <!-- IN USE -->
        <div class="right-side" style="display: none; margin-left:15%;" id="usingto">
          <div class="box-topic">กำลังใช้งาน</div>
          <?php

          $slcinusetool = "SELECT * FROM tool_specific_table WHERE tool_status = 2";
          $resinuse = $conn->query($slcinusetool);
          $countinuse = mysqli_num_rows($resinuse);

          ?>
          <div class="number"><?php echo number_format($countinuse, 0, '.', ','); ?></div>
        </div>

        <!-- DEFECTIVE -->
        <div class="right-side" style="display: none; margin-left:15%;" id="defectt" >
          <div class="box-topic">ชำรุด</div>
          <?php

          $slcdefecttool = "SELECT * FROM tool_specific_table WHERE tool_status = 3";
          $resdefect = $conn->query($slcdefecttool);
          $countdefect = mysqli_num_rows($resdefect);

          ?>
          <div class="number"><?php echo number_format($countdefect, 0, '.', ','); ?></div>
        </div>

        <!-- LOST -->
        <div class="right-side" style="display: none; margin-left:15%;" id="lostool">
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
          <canvas id="charttestone"></canvas>
        </div>

      </div>
      <div class="top-sales box">
        <div class="title">แผนภูมิ</div>
        <canvas id="toolchart"></canvas>
      </div>
    </div>
  </div>
  </section>

  <?php

  $ledgercall = "SELECT * FROM ledger_table WHERE queue_status = 7 OR queue_status = 6 ORDER BY ledger_s_date ASC";
  $reslgc = $conn->query($ledgercall);

  $data = array();
  $ardate = array();
  while ($row = mysqli_fetch_assoc($reslgc)) {

    $curdate = $row["ledger_s_date"];

    if (!in_array($curdate, $ardate)) {

      $ledgercurdate = "SELECT * FROM ledger_table WHERE ledger_s_date = '$curdate'";
      $rescd = $conn->query($ledgercurdate);
      $lcurdcount = mysqli_num_rows($rescd);

      $data[] = array(
        "date" => $curdate,
        "usage" => $lcurdcount
      );
      $ardate[] = $curdate;
    }
  }

  $jsonData = json_encode($data);

  // print_r($jsonData);

  echo "<script>var ledgerdata = " . $jsonData . ";</script>";

  $typecount = "SELECT * FROM tool_type_table";
  $restc = $conn->query($typecount);

  $typedata = array();

  while ($tcrow = mysqli_fetch_array($restc)) {
    $ttype = $tcrow["tool_type"];
    $typename = $tcrow["type_name"];

    $counter = 0;

    $talltb = "SELECT * FROM tool_all_table WHERE tool_type = '$ttype'";
    $resttb = $conn->query($talltb);

    while ($toolrow = mysqli_fetch_array($resttb)) {
      $toolid = $toolrow["tool_all_ID"];

      $tcount = "SELECT * FROM tool_specific_table WHERE tool_all_ID = '$toolid'";
      $restoc = $conn->query($tcount);
      $countrtoc = mysqli_num_rows($restoc);
      $counter += $countrtoc;
    }

    if ($counter > 0) {
      $typedata[] = array(
        "type" => $typename,
        "quantity" => $counter
      );
    }
  }

  $typejson = json_encode($typedata);

  // print_r($typejson);

  echo "<script>var typedata = " . $typejson . "</script>";

  ?>

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
    
    var ctone = document.getElementById("charttestone").getContext("2d");
    var tchrt = document.getElementById("toolchart").getContext("2d");

    var labels = [];
    var usagedata = [];

    ledgerdata.forEach(function(element) {
      labels.push(element.date);
      usagedata.push(element.usage);
    });

    var chctone = new Chart(ctone, {
      type: "bar",
      data: {
        labels: labels,
        datasets: [{
          label: "Usage Times",
          data: usagedata,
          fill: true
        }]
      },
      options: {
        scales: {
          xAxes: [{
            type: "time",
            time: {
              unit: "month",
              displayFormats: {
                month: "MMMM YYYY"
              },
              parser: function(date) {
                return moment(date, "YYYY-MM-DD");
              }
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });

    var types = [];
    var typequan = [];

    typedata.forEach(function(element) {
      types.push(element.type);
      typequan.push(element.quantity);
    });

    var chtype = new Chart(tchrt, {
      type: "pie",
      data: {
        labels: types,
        datasets: [{
          label: "Quantity",
          data: typequan,
          fill: true
        }]
      }
    });
  </script>

</body>

</html>