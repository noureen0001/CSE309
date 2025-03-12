<?php

// Load the CSV file and process data
$csvFile = 'GGS_new.csv';
$data = [];
$maleCount = 0;
$femaleCount = 0;

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    $headers = fgetcsv($handle, 1000, ';'); // Read headers
    while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
        // Ensure the row has the same number of elements as headers
        if (count($row) == count($headers)) {
            $entry = array_combine($headers, $row);
            $sex = $entry['sex'] ?? null;
            if ($sex == 1) {
                $maleCount++;
            } elseif ($sex == 2) {
                $femaleCount++;
            }
        }
    }
    fclose($handle);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Male vs Female Events</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 50%; height:30%;">
        <canvas id="genderChart" width="400" height="400"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Count',
                    data: [<?php echo $maleCount; ?>, <?php echo $femaleCount; ?>],
                    backgroundColor: ['blue', 'pink']
                }]
            }
        });
    </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_URI'] == '/statuses') {
    header('Content-Type: application/json');
    echo json_encode([
        'male' => [
            'count' => $maleCount,
            'color' => 'blue'
        ],
        'female' => [
            'count' => $femaleCount,
            'color' => 'pink'
        ]
    ]);
    exit;
}
?>
