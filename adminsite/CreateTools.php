<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tailwind CSS Edit Post UI with form plugins</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
  <link rel="stylesheet" href="post.css">

</head>

<body>
  <!-- create Post -->
  <div style="margin-top: -3%;">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
      <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl" style="margin-top: -5%;">
        <div class="mb-4">
          <h1 class="font-serif text-3xl font-bold underline decoration-gray-400" style="margin-top: -5%;">
            Create Tool Data
          </h1>
        </div>

        <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
          <form method="POST" action="../adminbackend/addtools.php">
            <!-- Text Input -->
            <div>
              <label class="block text-sm font-bold text-gray-700" for="title">
                ID เครื่องมือ
              </label>
              <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="toolidinput" id="toolidinput" placeholder="Insert Tool ID"/>
              <label class="block text-sm font-bold text-gray-700" for="title">
                ชื่อ
              </label>
              <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="toolnameinput" id="toolnameinput" placeholder="Insert Name"/>
              <label class="block text-sm font-bold text-gray-700" for="title">
                ยี่ห้อ
              </label>
              <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="branddef" id="branddef" placeholder="Insert Brand"/>
              <label class="block text-sm font-bold text-gray-700" for="title">
                รุ่น
              </label>
              <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-left focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="defmodel" id="defmodel" placeholder="Insert Model"/>
            </div>
            <!-- Image -->
            <div class='file-input' style="margin-top: 2%;">
              <label class='label'>เลือกรูปภาพ: </label>
              <input type='file'>
            </div>
            <!-- category -->
            <div>
              <label class='label'>หมวดหมู่: </label>
              <select style="height: 20px;" name="categoryinput" id="categoryinput">
                <option>Unspecified</option>
                <option>Camera</option>
                <option>Lighting</option>
                <option>Microphone</option>
              </select>
            </div>
            <!-- Description -->
            <div class="mt-4">
              <label class="block text-sm font-bold text-gray-700" for="password">
                Description
              </label>
              <textarea name="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="400">รายละเอียดต่าง ๆ ที่จะเขียนให้กับเครื่องมือ</textarea>
            </div>

            <div class="flex items-center justify-start mt-4 gap-x-2">
              <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                สร้าง
              </button>
              <button type="reset" class="px-6 py-2 text-sm font-semibold text-gray-100 bg-gray-400 rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                ยกเลิก
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>