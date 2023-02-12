<html>

<head>

</head>

<body>
    <?php

    include('../connectdb.php');

    ?>

    <div style="width: 100%;">
        <canvas id="charttestone"></canvas>
    </div>
    <div>
        <div>
            <p></p>
        </div>
        <div>
            <canvas id="toolchart"></canvas>
        </div>
    </div>
</body>

<?php

$ledgercall = "SELECT * FROM ledger_table WHERE queue_status = 7 OR queue_status = 6 ORDER BY ledger_s_date ASC";
$reslgc = $conn->query($ledgercall);

$data = array();
$ardate = array();
while ($row = mysqli_fetch_assoc($reslgc)) {

    $curdate = $row["ledger_s_date"];

    if (!in_array($curdate, $ardate)) {

        $ledgercurdate = "SELECT * FROM ledger_table WHERE ledger_s_date = '$curdate'";
        $rescd = $conn->query($ledgercurdate);
        $lcurdcount = mysqli_num_rows($rescd);

        $data[] = array(
            "date" => $curdate,
            "usage" => $lcurdcount
        );
        $ardate[] = $curdate;
    }
}

$jsonData = json_encode($data);

print_r($jsonData);

echo "<script>var ledgerdata = " . $jsonData . ";</script>";

$typecount = "SELECT * FROM tool_type_table";
$restc = $conn->query($typecount);

$typedata = array();

while ($tcrow = mysqli_fetch_array($restc)) {
    $ttype = $tcrow["tool_type"];
    $typename = $tcrow["type_name"];

    $counter = 0;

    $talltb = "SELECT * FROM tool_all_table WHERE tool_type = '$ttype'";
    $resttb = $conn->query($talltb);

    while ($toolrow = mysqli_fetch_array($resttb)) {
        $toolid = $toolrow["tool_all_ID"];

        $tcount = "SELECT * FROM tool_specific_table WHERE tool_all_ID = '$toolid'";
        $restoc = $conn->query($tcount);
        $countrtoc = mysqli_num_rows($restoc);
        $counter += $countrtoc;
    }

    if ($counter > 0) {
        $typedata[] = array(
            "type" => $typename,
            "quantity" => $counter
        );
    }
}

$typejson = json_encode($typedata);

print_r($typejson);

echo "<script>var typedata = " . $typejson . "</script>";

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctone = document.getElementById("charttestone").getContext("2d");
    var tchrt = document.getElementById("toolchart").getContext("2d");

    var labels = [];
    var usagedata = [];

    ledgerdata.forEach(function(element) {
        labels.push(element.date);
        usagedata.push(element.usage);
    });

    var chctone = new Chart(ctone, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Usage Times",
                data: usagedata,
                fill: true
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: "time",
                    time: {
                        unit: "month",
                        displayFormats: {
                            month: "MMMM YYYY"
                        },
                        parser: function(date) {
                            return moment(date, "YYYY-MM-DD");
                        }
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var types = [];
    var typequan = [];

    typedata.forEach(function(element) {
        types.push(element.type);
        typequan.push(element.quantity);
    });

    var chtype = new Chart(tchrt, {
        type: "pie",
        data: {
            labels: types,
            datasets: [{
                label: "Quantity",
                data: typequan,
                fill: true
            }]
        }
    });
</script>

</html>