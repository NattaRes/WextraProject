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
          แก้ไขเครื่องมือ
        </h1>
      </div>

      <?php
      include("../connectdb.php");

      $url = $_SERVER['REQUEST_URI'];

      // echo $url;

      $partscrap = parse_url($url);

      parse_str($partscrap['query'], $parts);

      $toolidall = $parts['toolidall'];

      $tablequery = "SELECT * FROM tool_all_table 
        INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand 
        INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type 
        WHERE tool_all_ID = '$toolidall'";

      $res = $conn->query($tablequery);

      while ($row = mysqli_fetch_array($res)) {
        $toolid = $row['tool_all_ID'];
        $brandname = $row['brand_name'];
        $tname = $row['tool_name'];
        $tmodel = $row['tool_model'];
        $typename = $row['type_name'];
        $desc = $row['tool_desc'];

        $typeid = $row['tool_type'];
        $brandid = $row['tool_brand'];
      }

      $typetable = "SELECT * FROM tool_type_table";
      $typeres = $conn->query($typetable);

      $brandtable = "SELECT * FROM tool_brand_table";
      $brandres = $conn->query($brandtable);

      // while ($row = mysqli_fetch_array($res)) {
      //     echo print_r($row);
      // }
      ?>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
        <form method="POST" action="../adminbackend/edittools.php?toolidall=<?php echo $toolidall; ?>">
          <!-- Text Input -->
          <div style="float: left ; width:50%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              ID เครื่องมือ
            </label>
            <input class="block mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:90%;" type="text" name="toolidinput" id="toolidinput" placeholder="เพิ่ม ID" value="<?php echo $toolid; ?>" />
          </div>
          <div style="float: left; width:50%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              ชื่อ
            </label>
            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="toolnameinput" id="toolnameinput" placeholder="เพิ่มชื่อ" value="<?php echo $tname; ?>" />
          </div>
          <div style="float: left; width:50%; margin-top:2%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              ยี่ห้อ
            </label>
            <!-- <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:90%;" type="text" name="branddef" id="branddef" placeholder="เพิ่มยี่ห้อ" value="<?php echo $brandname; ?>" /> -->
            <select style="height: 100%; margin-top:2%;" name="branddef" id="branddef">
              <?php
              while ($brandrow = mysqli_fetch_array($brandres)) {
                echo '<option value="' . $brandrow["tool_brand"] . '"';
                if ($brandid == $brandrow["tool_brand"]) {
                  echo 'selected="selected"';
                }
                echo '>' . $brandrow["brand_name"] . '</option>';
              }
              ?>
            </select>
          </div>
          <div style="float: left; width:50%; margin-top:2%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              รุ่น
            </label>
            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="defmodel" id="defmodel" placeholder="เพิ่มรุ่น" value="<?php echo $tmodel; ?>" />
          </div>
          <!-- category -->
          <div>
            <label class='label' style="height: 20px; margin-bottom:2%;">หมวดหมู่: </label>
            <select style="height: 100%; margin-top:2%;" name="categoryinput" id="categoryinput">
              <?php
              while ($typerow = mysqli_fetch_array($typeres)) {
                echo '<option value="' . $typerow["tool_type"] . '"';
                if ($typeid == $typerow["tool_type"]) {
                  echo 'selected="selected"';
                }
                echo '>' . $typerow["type_name"] . '</option>';
              }
              ?>
            </select>
          </div>
          <!-- Image -->
          <div class='file-input'>
            <label class='label' style="margin-top:2%;">เลือกรูปภาพ: </label>
            <input type='file' style="margin-top:2%;">
          </div>

          <!-- Description -->
          <div class="mt-4">
            <label class="block text-sm font-bold text-gray-700" for="password">
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
              margin-left:80%;
              background: #015C92;              
              color:#fff;
              cursor:pointer;">
              ยืนยัน
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