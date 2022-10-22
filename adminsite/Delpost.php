<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind CSS Edit Post UI with form plugins</title>
    <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
    <link rel="stylesheet" href="deleteform.css">

</head>

<body>

    <?php

    $url = $_SERVER['REQUEST_URI'];

    // echo $url;

    $partscrap = parse_url($url);

    parse_str($partscrap['query'], $parts);

    $postID = $parts['postid'];

    ?>
    
    <!-- create Post -->
    <div style="margin-top: 10%;">
        <div>
            <div class="mb-4">
                <h1 style="font-size: 30px; margin-left:10%;">
                    ลบโพสต์
                </h1>
            </div>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10" style="width:80%; margin-left:10%; margin-right:20%; height:100%">
                <form method="POST" action="../adminbackend/addtools.php">
                    <!-- Text Input -->
                    <div style="float: left ;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            หัวข้อ :
                        </label>
                        <label style="font-size: 18px;">
                            Husk LIGHT
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            วันที่ :
                        </label>
                        <label style="font-size: 18px;">
                            11/11/2565
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom:1%;">
                        <label style="font-size: 18px;">
                            ภาพ :
                        </label>
                        <label style="font-size: 18px;">
                            <img src="" alt="">
                        </label>
                    </div>
                    <div style="clear: left;  margin-bottom: 1%;">
                        <label style="font-size: 18px;">
                            คำอธิบาย :
                        </label>
                        <label style="font-size: 18px;">
                            A camera made from duriano
                        </label>
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