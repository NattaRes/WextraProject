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
        array_push($uidcontainer, array("user" => $uidone, "lo" => $uactlo, "la" => $uactla));
    }
}

$jarr = json_encode($uidcontainer);

// print_r($jarr);
// print_r($uidcontainer);

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
                center: ol.proj.fromLonLat([102.0206741, 14.8823084]),
                zoom: 14
            })
        });

        usercontain.forEach(function(marker) {
            var cuid = marker["user"];
            var clog = marker["lo"];
            var clat = marker["la"];
            var icfeature = new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.fromLonLat([clog, clat])),
                name: cuid
            });
            var iconStyle = new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 55],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    src: 'https://openlayers.org/en/latest/examples/data/icon.png'
                }),
                text: new ol.style.Text({
                    text: cuid,
                    font: 'bold 30px TH Sarabun New'
                })
            });
            icfeature.setStyle(iconStyle);
            var vectorSource = new ol.source.Vector({
                features: [icfeature]
            });
            var markerVectorLayer = new ol.layer.Vector({
                source: vectorSource
            });
            // icfeature.on("click", function(marker) {
            //     console.log(marker["user"]);
            // });
            map.addLayer(markerVectorLayer);
        });
    </script>
</body>

</html>