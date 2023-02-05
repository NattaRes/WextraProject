<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="observui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.2.2/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <script src="https://code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
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

    <div id="modal" class="modal">
        <div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
            <span class="close" style="margin-left:95%; font-size: 35px;">&times;</span>
            <div>
                <p id="ledid"></p>
            </div>
            <div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("modal");
        var span = document.getElementsByClassName("close")[0];

        const ptest = document.getElementById("ledid");

        function showmodal(inuid) {
            modal.style.display = "block";
            ptest.innerHTML = inuid;
        }

        function closemodal() {
            modal.style.display = "none";
            ptest.innerHTML = "";
        }

        span.onclick = function() {
            closemodal();
        }

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
                type: 'click',
                geometry: new ol.geom.Point(ol.proj.fromLonLat([clog, clat])),
                name: cuid
            });
            var iconStyle = new ol.style.Style({
                image: new ol.style.Icon({
                    scale: 0.7,
                    rotateWithView: false,
                    anchor: [0.5, 1],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'fraction',
                    opacity: 1,
                    src: '//raw.githubusercontent.com/jonataswalker/map-utils/master/images/marker.png'
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

        map.on('click', function(ckevent) {

            var f = map.forEachFeatureAtPixel(
                ckevent.pixel,
                function(ft, layer) {
                    return ft;
                }
            );

            if (f && f.get('type') == 'click') {
                var geometry = f.getGeometry();
                var coord = geometry.getCoordinates();

                var muid = f.get('name');

                showmodal(muid);

            } else {

                closemodal();

            }
        });
    </script>
</body>

</html>