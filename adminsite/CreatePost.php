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
  <div style="margin-top: 10%;">
    <div>
      <div class="mb-4">
        <h1 style="font-size: 30px; margin-left:10%;">
          เพิ่มโพสต์
        </h1>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
        <form method="POST" action="../adminbackend/addpost.php">
          <!-- Text Input -->
          <div style="float: left ; width:50%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              หัวข้อ
            </label>
            <input class="block mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:90%;" type="text" name="pti" id="pti" placeholder="เพิ่มหัวข้อ" />
          </div>
          <div style="float: left; width:50%;">
            <label class="block text-sm font-bold text-gray-700" for="title">
              วันที่
            </label>
            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="width:40%;" type="date" name="pdt" id="pdt" placeholder="เพิ่มชื่อ" />
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
            <textarea name="description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="คำอธิบายโพสต์"></textarea>
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
              สร้าง
            </button>
          </div>
        </form>
        <a href="Post.php?sfi=all&sinput=">
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
        </a>
      </div>
    </div>
  </div>

</body>

</html>