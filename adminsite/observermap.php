<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wextra</title>
    <!-- google map api ต้อง billing setup ก่อน -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
</head>

<body>
    <div id="dismap" style="width:100%;height:100%;"></div>

    <script>
        const dismap = document.getElementById("dismap");

        var gmap = new google.maps.Map(dismap, {
            zoom: 4,            
        });
    </script>
</body>

</html>