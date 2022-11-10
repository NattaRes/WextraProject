<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Digicart</title>
  <link rel="stylesheet" href="menubaruser.css">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<body>

  <div class="header">

  <?php 

  include("../connectdb.php");
  
  $uid = $_COOKIE["userck"];

  $usersql = "SELECT * FROM user WHERE UID = '$uid'";

  $queuser = $conn->query($usersql);

  while ($rowuser = mysqli_fetch_array($queuser)) {
    $username = $rowuser["username"];
  }

  ?>

    <ul>
      <h3 class="nameheader"><?php echo $uid . " " . $username; ?></h3>
    </ul>
    <img src="../image/tools/logoDigi.png" class="logoimg" style="margin-top: -1%; margin-left:5%;" />

  </div>

  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li style="border-radius: 20px 20px 0px 0px ;">
        <a href="home.php" target="Changepage1" onclick="changePageTitlehome()">
          <img src="../image/icon/home.png" class="iconimg" />
          <span>หน้าแรก</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="changePageTitlevalue()" id="myBtn">
          <img src="../image/icon/warning.png" class="iconimg" />
          <span>กฎการยืม</span>
        </a>
      </li>
      
      <li>
        <a href="Alltools.php?sinput=&tpin=" target="Changepage1" onclick="changePageTitletools()">
          <img src="../image/icon/photo-camera (1).png" class="iconimg" />
          <span>เครื่องมือ</span>
        </a>
      </li>
     
      <li>
        <a href="Cart.php" target="Changepage1" onclick="changePageTitlecart()">
          <img src="../image/icon/shopping-cart (2).png" class="iconimg" />
          <span>ตะกร้า</span>
        </a>
      </li>
      <li>
        <a href="Status.php" target="Changepage1" onclick="changePageTitlest()">
          <img src="../image/icon/hourglass.png" class="iconimg" />
          <span>เช็คสถานะ</span>
        </a>
      </li>
      <li>
        <a href="Blog.php" target="Changepage1" onclick="changePageTitlenews()">
          <img src="../image/icon/notification.png" class="iconimg" />
          <span>ข่าวสาร</span>
        </a>
      </li>
  
      <!--<li>
        <a href="Historyuser.html" target="Changepage1" onclick="changePageTitlest()">
          <img src="../image/icon/hourglass.png" class="iconimg" />
          <span>ประวัติการยืม</span>
        </a>
      </li>-->
      <li>
        <a href="Profile.php" target="Changepage1" onclick="changePageTitlepr()">
          <img src="../image/icon/profile.png" class="iconimg" />
          <span>โปรไฟล์</span>
        </a>
      </li>

      <li class="log_out">
        <a href="../logmeout.php">
          <img src="../image/icon/logout.png" class="iconimg"/>
          <span style="margin-left: -5%;">ออกจากระบบ</span>
        </a>
      </li>
    </ul>
  </div>
  <div id='center' class="frame">
    <iframe src="home.php" name="Changepage1" id="iframeid" frameborder="0" scrolling="auto" height="100%" width="100%"
      style="border: none; margin-bottom: -1%; margin-top: 0%;">
    </iframe>
    <!--<footer class="footer" style="height: 10%; background-color: #015C92; ">
      <img src="../image/icon/footer.png" style="height:80%; margin-left: 40%; margin-bottom: -3%; "/>
     </footer>-->
    <!-- Trigger/Open The Modal -->
 

    <!-- The Modal -->
    <div id="myModal" class="modal">
     
      <!-- Modal content -->
      <div class="modal-content" style="margin-top: 1%;">
        <span class="close" >&times;</span>
        <div>
          <h2 style="text-align: center; margin-top: 2%; margin-left: 10%;">เงื่อนไขการยืม</h2> 
        </div>
        <div id="scroll_demo">
        <div style="margin-bottom: 2%;">1.ผู้ที่จะยืมวัสดุ อุปกรณ์ กรุณาติดต่อสอบถามเจ้าหน้าที่ห้องปฏิบัติการที่ดูแลและกรอกแบบยืมวัสดุ อุปกรณ์ล่วงหน้าอย่างน้อย 2 วันทำการ</div>
        <div style="margin-bottom: 2%;">2.การขอยืมวัสดุ อุปกรณ์ ผู้ใช้ต้องทำการยืม และส่งวันต่อวันเท่านั้น (ภายใน1วันของเวลาทำการ 08:30 ถึง 16:30)</div>
        <div style="margin-bottom: 2%;">3.ในกรณีเป็นการยืมกล้อง DVCAM ผู้ขอใช้จะต้องทำหนังสือขอ<br>เจ้าหน้าที่ จากห้องปฏิบัติการเพื่อร่วมปฏิบัติงานด้วยอย่างน้อย 1 คน</div>
        <div style="margin-bottom: 2%;">4.ในกรณีที่เกิดความเสียหายกับเครื่องมือหรืออุปกรณ์ อันเนื่องจากขอผู้รับบริการ(ผู้ยืม) จะต้องชดใช้และรับผิดชอบค่าใช้จ่ายที่เกิดขึ้นอันเนื่องจากความเสียหาย/ชำรุด ของเครื่องมือและอุปกรณ์ทุกกรณี</div>
        <div style="margin-bottom: 2%;">5.ทางห้องปฏิบัติการเทคโนโลยีสารสนเทศขอสงวนสิทธิ์ ที่จะพิจารณาไม่ให้ยืมอุปกรณ์บางอย่าง ที่เจ้าหน้าที่ห้องปฏิบัติการ พิจารณาเห็นแล้วว่าไม่ควรให้ยืม</div>
        <div style="margin-bottom: 2%;">6.การส่ง-คืนวัสดุอุปกรณ์จะต้องปฏิบัติตามวันเวลาที่กำหนดไว้ในแบบฟอร์มเท่านั้น หากไม่ปฏิบัติตามทางห้องปฏิบัติการจะพิจารณาในการให้ยืมอุปกรณ์ในครั้งถัดไป</div>
        <div style="margin-bottom: 2%;">7.ควรใช้เครื่องมือและอุปกรณ์ด้วยความระมัดระวัง</div>
        <div style="margin-bottom: 2%;">8.ควรตรวจเช็คสภาพของอุปกรณ์การยืมทุกครั้งก่อนนำไปใช้ในงาน</div>
        <div style="margin-bottom: 2%;">9.การส่งคืนอุปกรณ์ทุกครั้ง จะต้องมีการตรวจสภาพของอุปกรณ์ที่นำไปใช้ทุกครั้งกับเจ้าหน้าที่ห้องปฏิบัติการก่อนทำส่ง</div>
      </div>
    </div>
    </div>
  </div>

  <!--<div class="modal" style="margin-right: 35%; margin-left:60%; margin-bottom:1%; width: 550px; height: 680px;">
    <div style="margin-left: 80%; margin-top: 5%;">
  </div>
        <div class="center-text" style="margin-bottom: 2%; margin-left: 38%; margin-right: 35%;">
          <h2>เงื่อนไขการยืม</h2> 
           
     </div>
     <div class="bottom-content" >
        <div  id="scroll_demo" style="margin-left: 5%;">
          <div style="margin-bottom: 2%;">1.ผู้ที่จะยืมวัสดุ อุปกรณ์ กรุณาติดต่อสอบถามเจ้าหน้าที่ห้องปฏิบัติการ<br>ที่ดูแลและกรอกแบบยืมวัสดุ อุปกรณ์ล่วงหน้าอย่างน้อย 2 วันทำการ</div>
          <div style="margin-bottom: 2%;">2.การขอยืมวัสดุ อุปกรณ์ ผู้ใช้ต้องทำการยืม และส่งวันต่อวันเท่านั้น <br>(ภายใน1วันของเวลาทำการ 08:30 ถึง 16:30)</div>
          <div style="margin-bottom: 2%;">3.ในกรณีเป็นการยืมกล้อง DVCAM ผู้ขอใช้จะต้องทำหนังสือขอ<br>เจ้าหน้าที่ จากห้องปฏิบัติการเพื่อร่วมปฏิบัติงานด้วยอย่างน้อย 1 คน</div>
          <div style="margin-bottom: 2%;">4.ในกรณีที่เกิดความเสียหายกับเครื่องมือหรืออุปกรณ์ อันเนื่องจาก<br>ขอผู้รับบริการ(ผู้ยืม) จะต้องชดใช้และรับผิดชอบค่าใช้จ่ายที่เกิดขึ้นอันเนื่องจากความเสียหาย/ชำรุด ของเครื่องมือและอุปกรณ์ทุกกรณี</div>
          <div style="margin-bottom: 2%;">5.ทางห้องปฏิบัติการเทคโนโลยีสารสนเทศขอสงวนสิทธิ์ ที่จะพิจารณา<br>ไม่ให้ยืมอุปกรณ์บางอย่าง ที่เจ้าหน้าที่ห้องปฏิบัติการ พิจารณาเห็นแล้วว่าไม่ควรให้ยืม</div>
          <div style="margin-bottom: 2%;">6.การส่ง-คืนวัสดุอุปกรณ์จะต้องปฏิบัติตามวันเวลาที่กำหนดไว้ในแบบฟอร์มเท่านั้น หากไม่ปฏิบัติตามทางห้องปฏิบัติการจะพิจารณาในการ<br>ให้ยืมอุปกรณ์ในครั้งถัดไป</div>
          <div style="margin-bottom: 2%;">7.ควรใช้เครื่องมือและอุปกรณ์ด้วยความระมัดระวัง</div>
          <div style="margin-bottom: 2%;">8.ควรตรวจเช็คสภาพของอุปกรณ์การยืมทุกครั้งก่อนนำไปใช้ในงาน</div>
          <div style="margin-bottom: 2%;">9.การส่งคืนอุปกรณ์ทุกครั้ง จะต้องมีการตรวจสภาพของอุปกรณ์ที่นำไปใช้ทุกครั้งกับเจ้าหน้าที่ห้องปฏิบัติการก่อนทำส่ง</div>
              
        </div>
     </div>
     <div class="close-btn">
      <button>Close Modal</button>
   </div>
  </div>-->

  <script type="text/javascript">
    function changePageTitlehome() {
      newPageTitle = 'Home';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitletools() {
      newPageTitle = 'Tools';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitlevalue() {
      newPageTitle = 'Values';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitlecart() {
      newPageTitle = 'Cart';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitlenews() {
      newPageTitle = 'News';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitlest() {
      newPageTitle = 'Status';
      document.querySelector('title').textContent = newPageTitle;
    }
    function changePageTitlepr() {
      newPageTitle = 'Profile';
      document.querySelector('title').textContent = newPageTitle;
    }
  </script>

  <!-- Popup -->
  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>