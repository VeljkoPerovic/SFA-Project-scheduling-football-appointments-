<link rel="stylesheet" href='../styles/style.css' />
<?php
include_once '../core/dbConnection.php';

$sqlTotal = "SELECT datum_termina, COUNT(*) as broj_termina FROM termin GROUP BY datum_termina";
$resultTotal = mysqli_query($conn, $sqlTotal);

$labelsTotal = [];
$dataTotal = [];

while ($rowTotal = mysqli_fetch_assoc($resultTotal)) {
    $labelsTotal[] = $rowTotal['datum_termina'];
    $dataTotal[] = $rowTotal['broj_termina'];
}

$sqlTeren = "SELECT teren_termina, COUNT(*) as broj_termina_teren FROM termin GROUP BY teren_termina";
$resultTeren = mysqli_query($conn, $sqlTeren);

$labelsTeren = [];
$dataTeren = [];

while ($rowTeren = mysqli_fetch_assoc($resultTeren)) {
    $labelsTeren[] = $rowTeren['teren_termina'];
    $dataTeren[] = $rowTeren['broj_termina_teren'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex; 
            justify-content: space-around;
            margin-top: 50px;
        }

        canvas {
            width: 900px !important; 
            height: 600px !important;
            background-color: white; 
            border: 1px solid white; 
            border-radius: 5px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>


<div class="chart-container">
    <canvas id="terminChartTotal"></canvas>
    <canvas id="terminChartTeren"></canvas>
</div>

<script>
// Postavljanje podataka iz PHP-a u JavaScript za ukupan broj rezervacija
var dataTotal = {
    labels: <?php echo json_encode($labelsTotal); ?>,
    datasets: [{
        label: 'Broj rezervacija po datumu',
        data: <?php echo json_encode($dataTotal); ?>,
        backgroundColor: 'grey',
        borderColor: 'rgba(255, 255, 255, 1)', 
        borderWidth: 1
    }]
};

var ctxTotal = document.getElementById('terminChartTotal').getContext('2d');
var myChartTotal = new Chart(ctxTotal, {
    type: 'bar',
    data: dataTotal,
    options: getChartOptions()
});

// Postavljanje podataka iz PHP-a u JavaScript za broj rezervacija po terenu
var dataTeren = {
    labels: <?php echo json_encode($labelsTeren); ?>,
    datasets: [{
        label: 'Broj rezervacija po terenu',
        data: <?php echo json_encode($dataTeren); ?>,
        backgroundColor: 'grey', 
        borderColor: 'rgba(255, 255, 255, 1)', 
        borderWidth: 1
    }]
};

var ctxTeren = document.getElementById('terminChartTeren').getContext('2d');
var myChartTeren = new Chart(ctxTeren, {
    type: 'bar',
    data: dataTeren,
    options: getChartOptions()
});

// Funkcija za zajedničke opcije grafikona
function getChartOptions() {
    return {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 20, 
                        weight: 'bold' 
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 20, 
                        weight: 'bold' 
                    }
                }
            }
        },
        responsive: true, 
        maintainAspectRatio: false, 
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 20, 
                        weight: 'bold' 
                    },
                    color: 'black' 
                }
            }
        }
    };
}
</script>

</body>
</html>