<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="observui.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;500&display=swap" rel="stylesheet">
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

        $usercrd = "SELECT * FROM user WHERE UID = '$uidone'";
        $resurcr = $conn->query($usercrd);
        while ($urcrow = mysqli_fetch_array($resurcr)) {
            $username = $urcrow["username"];
            $email = $urcrow["email"];
            $phone = $urcrow["phonenum"];
            $uactlo = $urcrow["act_lo"];
            $uactla = $urcrow["act_la"];
        }

        $ledgerdata = "SELECT * FROM ledger_table 
            INNER JOIN tool_all_table ON ledger_table.tool_all_ID = tool_all_table.tool_all_ID
            INNER JOIN tool_type_table ON tool_all_table.tool_type = tool_type_table.tool_type
            INNER JOIN tool_brand_table ON tool_all_table.tool_brand = tool_brand_table.tool_brand
            WHERE user_UID = '$uidone' AND queue_status = 6";
        $reslgrdata = $conn->query($ledgerdata);

        $tlist = array();
        $tlcheck = array();

        while ($lgrow = mysqli_fetch_array($reslgrdata)) {

            $curtoid = $lgrow["tool_all_ID"];

            $countlgrtool = "SELECT * FROM ledger_table WHERE user_UID = '$uidone' AND queue_status = 6 AND tool_all_ID = '$curtoid'";
            $resctlgrt = $conn->query($countlgrtool);
            $numrctgrt = mysqli_num_rows($resctlgrt);

            if (!in_array($curtoid, $tlcheck)) {

                $tlcheck[] = $curtoid;

                $nameformat = $lgrow["tool_name"] . " " . $lgrow["brand_name"] . " " . $lgrow["tool_model"];

                $tlist[] = array(
                    "toolid" => $curtoid,
                    "name" => $nameformat,
                    "quantity" => $numrctgrt
                );
            }
        }

        array_push($uidcontainer, array(
            "user" => $uidone,
            "username" => $username,
            "email" => $email,
            "phone" => $phone,
            "lo" => $uactlo,
            "la" => $uactla,
            "list" => $tlist
        ));
    }
}

$jarr = json_encode($uidcontainer);

// print_r($jarr);
// print_r($uidcontainer);

echo "<script>var usercontain = " . $jarr . ";</script>";

?>

<html>
<body>

    <div id="dismap" style="width:100%;height:100%;"></div>

    <div id="modal" class="modal">
        <div class="modal-content" style=" width: 40%; margin-left:30%; border-radius: 33px; box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.25);">
            <span class="close" style="margin-left:95%; font-size: 35px;">&times;</span>
            <label style="font-size: 18px;   font-family: 'Kanit', sans-serif;">รายละเอียด</label>

            <div>
                <div>
            <label style="font-size: 16px;  font-family: 'Kanit', sans-serif;">รหัสนักศึกษา : <lebel style="font-size: 16px;" id="ledid"></lebel></label>
                </div>
                <div>
            <label style="font-size: 16px;  font-family: 'Kanit', sans-serif;">ชื่อ : <lebel style="font-size: 16px;" id="ledna"></lebel></label>
            </div>
            <div>
            <label style="font-size: 16px;  font-family: 'Kanit', sans-serif;">อีเมล : <lebel style="font-size: 16px;" id="ledem"></lebel></label>
            </div>
            <div>
            <label style="font-size: 16px; font-family: 'Kanit', sans-serif;">เบอร์โทรศัพท์ : <lebel style="font-size: 16px;" id="ledph"></lebel></label>
            </div>
                <div id="toolist">
                    <table>
                        <thead>
                            <tr style="margin-top:5%">
					

									
                                <th style="
										text-align: center;
										border-right: 2px solid rgb(194, 194, 194);
                                        border-top: 2px solid rgb(194, 194, 194);
                                        border-bottom: 2px solid rgb(194, 194, 194);
                                        border-left: 2px solid rgb(194, 194, 194);
                                        font-family: 'Kanit', sans-serif;
										width: 40%; font-size: 16px; background-color: white;">อุปกรณ์</th>
                                <th style="
										text-align: center;
										border-right: 2px solid rgb(194, 194, 194);
                                        border-top: 2px solid rgb(194, 194, 194);
                                        border-bottom: 2px solid rgb(194, 194, 194);
                                        font-family: 'Kanit', sans-serif;
                                        border-left: 2px solid rgb(194, 194, 194);
										width: 40%; font-size: 16px; background-color: white;">จำนวน</th>
                            </tr>
                        </thead>
                        <tbody style="
										text-align: center;
										border-right: 2px solid rgb(194, 194, 194);
                                        border-top: 2px solid rgb(194, 194, 194);
                                        border-bottom: 2px solid rgb(194, 194, 194);
                                        border-left: 2px solid rgb(194, 194, 194);
                                        font-family: 'Kanit', sans-serif;
										width: 40%; font-size: 16px; background-color: white;" id="modaltbody">
                        </tbody>
                    </table>
                </div>
            <div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("modal");
        var span = document.getElementsByClassName("close")[0];
        
        var modaltbody = document.getElementById("modaltbody");

        const pledid = document.getElementById("ledid");
        const pledna = document.getElementById("ledna");
        const pledem = document.getElementById("ledem");
        const pledph = document.getElementById("ledph");

        function showmodal(inuid) {
            modal.style.display = "block";
            pledid.innerHTML = inuid;

            for (let i = 0; i < usercontain.length; i++) {
                if (usercontain[i].user === inuid) {
                    pledna.innerHTML = usercontain[i].username;
                    pledem.innerHTML = usercontain[i].email;
                    pledph.innerHTML = usercontain[i].phone;

                    var toolist = usercontain[i].list;

                    usercontain[i].list.forEach(function(data) {
                        const row = document.createElement("tr");

                        var toolname = data["name"];
                        const namecell = document.createElement("td");
                        namecell.innerHTML = toolname;
                        row.appendChild(namecell);

                        var quantity = data["quantity"];
                        const quancell = document.createElement("td");
                        quancell.innerHTML = quantity;
                        row.appendChild(quancell);

                        modaltbody.appendChild(row);
                    });
                }
            }
        }

        function closemodal() {
            modal.style.display = "none";
            pledid.innerHTML = "";
            pledna.innerHTML = "";
            pledem.innerHTML = "";
            pledph.innerHTML = "";
            modaltbody.innerHTML = "";
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
            var cname = marker["username"];
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
                    text: cname,
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