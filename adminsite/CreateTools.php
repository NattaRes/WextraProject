<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Edit Post UI with form plugins</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="ctools.css">

</head>

<body>
  <!-- create Post -->
  <div style="margin-top: 8%;">
    <div>
      <div class="mb-4">
        <h1 style="font-size: 30px; margin-left:10%;">
          เพิ่มเครื่องมือ
        </h1>
      </div>

      <?php

      include("../connectdb.php");

      $typetable = "SELECT * FROM tool_type_table";
      $typeres = $conn->query($typetable);

      $brandtable = "SELECT * FROM tool_brand_table";
      $brandres = $conn->query($brandtable);

      ?>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
        <form method="POST" action="../adminbackend/addtools.php">
          <!-- Text Input -->
          <div style="float: left ; width:80%; margin-bottom:2%;">
            <label style="font-size:18px;" >
              ID เครื่องมือ :
            </label>
            <input style="width: 61.5%; border:1px solid black; border-radius:5px;" type="text" name="toolidinput" id="toolidinput" placeholder="เพิ่ม ID"  />
            </div>
          <div style="clear: left;  width:80%; margin-top:2%;">
            <label style="font-size:18px;" >
              ชื่อ :
            </label>
            <input style="width: 70%; border:1px solid black; border-radius:5px;" type="text" name="toolnameinput" id="toolnameinput" placeholder="เพิ่มชื่อ"  />
          </div>
          <div style="clear: left; width:80%; margin-top:2%;">
            <label style="font-size:18px;" >
              รุ่น :
            </label>
            <input style="width: 70%; border:1px solid black; border-radius:5px;" type="text" name="defmodel" id="defmodel" placeholder="เพิ่มรุ่น"  />
          </div>
          <div style="clear: left; width:100%; margin-top:0%;">
            <label style="font-size:18px;" >
              ยี่ห้อ :
            </label>
            <!-- <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:90%;" type="text" name="branddef" id="branddef" placeholder="เพิ่มยี่ห้อ" /> -->
            <select style="height: 100%; margin-top:2%;" name="branddef" id="branddef">
              <?php
              while ($brandrow = mysqli_fetch_array($brandres)) {
                echo '<option value="' . $brandrow["tool_brand"] . '">' . $brandrow["brand_name"] . '</option>';
              }
              ?>
            </select>
             <!-- category -->
          <label  style="font-size:18px; margin-left:2%;">หมวดหมู่: </label>
            <select style="height: 100%; margin-top:2%;" name="categoryinput" id="categoryinput">
              <?php
              while ($typerow = mysqli_fetch_array($typeres)) {
                echo '<option value="' . $typerow["tool_type"] . '">' . $typerow["type_name"] . '</option>';
              }
              ?>
            </select>
          </div>

         
          <!-- Image -->
          <div class='file-input'>
            <label style="margin-top:2%; font-size:18px;">เลือกรูปภาพ: </label>
            <input type='file' style="margin-top:2%;">
          </div>

           <!-- Description -->
           <div class="mt-4">
            <label style="font-size:18px;" >
              รายละเอียด
            </label>
            <textarea name="description" id="description" class="block w-full mt-1 border-gray-300
             rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 
             focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
             style="font-size:16px;"
            rows="4" placeholder="คำอธิบายเครื่องมือ..."></textarea>
          </div>


          <div class="flex items-center justify-start mt-4 gap-x-2">
            <button type="submit" style="width:150px;
              height:40px;
              border:none;
              font-size: 20px;
              border-radius:5px;
              margin-left:80%;
              background: #015C92;              
              color:#fff;
              cursor:pointer;">
              เพิ่ม
            </button>
            <button type="reset" style="width:150px;
              height:40px;
              border:none;
              font-size: 20px;
              border-radius:5px;
              background:rgba(192, 0, 0, 0.777);	
              color:#fff;
              cursor:pointer;">
              ยกเลิก
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>