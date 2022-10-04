<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">


</head>

<body>

    <div class="LoginForm">
        <form action="index.php" method="post">
            <!--Return ค่า-->
            <div class="title">
                <h3>Login</h3>
            </div>
            <div class="inputGroup">
                <input type="text" autocomplete="off" placeholder="User ID" id="lid" name="lid">

            </div>
            <div class="inputGroup">
                <input type="password" autocomplete="off" placeholder="Password" id="pwd" name="pwd">

            </div>
            <button class="submitForm" type="submit">Login</button>
        </form>
    </div>

    <?php
    ini_set('display_errors', 0);
    $lid = $_POST['lid'];
    $pwd = $_POST['pwd'];
    if ((isset($lid)) && (isset($pwd))) {
        include("logmein.php");
    }
    if (isset($falsetist)) {
        echo $falsetist;
    }
    ?>

</body>

</html>