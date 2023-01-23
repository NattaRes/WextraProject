<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.2.2/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
    <title>Wextra</title>
</head>

<?php

include("../connectdb.php");

$slconly = "SELECT que_owner_UID FROM queue_table WHERE queue_status = 6";
$reslcon = $conn->query($slconly);

$uidcontainer = array();

while ($slcrow = mysqli_fetch_array($reslcon)) {

    $uidone = $slcrow["que_owner_UID"];

    if (!in_array($uidone, $uidcontainer)) {

        $usercrd = "SELECT act_lo, act_la FROM user WHERE UID = '$uidone'";
        $resurcr = $conn->query($usercrd);
        while ($urcrow = mysqli_fetch_array($resurcr)) {
            $uactlo = $urcrow["act_lo"];
            $uactla = $urcrow["act_la"];
        }
        $uidcontainer[0][] = $uidone;
        $uidcontainer[1][] = $uactlo;
        $uidcontainer[2][] = $uactla;
    }
}

$jarr = json_encode($uidcontainer);
echo "<script>var usercontain = " . $jarr . ";</script>";

?>

<body>
    <div id="dismap" style="width:100%;height:100%;"></div>

    <script>

        var map = new ol.Map({
            target: 'dismap',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([100.9925, 15.8700]),
                zoom: 5
            })
        });
    </script>
</body>

</html>