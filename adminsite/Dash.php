<html>

<head>

</head>

<body>

    <div style="height: 50%;">
        <canvas id="charttestone"></canvas>
    </div>
    <div style="height: 50%;">
        <canvas id="charttestonetwo"></canvas>
    </div>
</body>

<?php

include('../connectdb.php');

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

$data2 = array();
$ardate2 = array();
while ($row = mysqli_fetch_assoc($reslgc)) {

    $curdate = $row["ledger_s_date"];
    $tifocd = new DateTime($curdate);
    $mocur = $tifocd->format('m');

    if (!in_array($mocur, $ardate2)) {

        $ledgercurdate = "SELECT * FROM ledger_table";
        $rescd = $conn->query($ledgercurdate);
        $lcurdcount = mysqli_num_rows($rescd);

        while ($monrow = mysqli_fetch_array($rescd)) {

            $modate = $monrow["ledger_s_date"];
            $dtfmtmodate = new DateTime($modate);
            $month = $dtfmtmodate->format('m');

            if ($month == $mocur) {

                $data2[] = array(
                    "month" => $mocur,
                    "usage" => $lcurdcount
                );
            }
        }

        $ardate2[] = $mocur;
    }
}

$jsonData = json_encode($data);
$jsonData2 = json_encode($data2);

print_r($jsonData);
print_r($jsonData2);

echo "<script>var ledgerdata = " . $jsonData . ";</script>";
echo "<script>var ledgerdatatwo = " . $jsonData2 . ";</script>";

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctone = document.getElementById("charttestone").getContext("2d");
    var ctonetwo = document.getElementById("charttestonetwo").getContext("2d");

    var labels = [];
    var usagedata = [];

    ledgerdata.forEach(function(element) {
        labels.push(element.date);
        usagedata.push(element.usage);
    });

    var labelstwo = [];
    var usagedatatwo = [];

    ledgerdatatwo.forEach(function(element) {
        labelstwo.push(element.date);
        usagedatatwo.push(element.usage);
    });

    var chctone = new Chart(ctone, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Usage Times",
                data: usagedata,
                fill: true,
                borderColor: "rgba(75,192,192,1)",
                pointRadius: 5,
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "rgba(75,192,192,1)"
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
    var chctone2 = new Chart(ctonetwo, {
        type: "line",
        data: {
            labels: labelstwo,
            datasets: [{
                label: "Usage Times",
                data: usagedatatwo,
                fill: true,
                borderColor: "rgba(75,192,192,1)",
                pointRadius: 5,
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "rgba(75,192,192,1)"
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
</script>

</html>