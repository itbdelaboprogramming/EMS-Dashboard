<?php
// // Connect to the database
include("../../../database/config.php");
$conn = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

$tablesSelected = $_GET['selectedOption'];

// Query the database
$stmt = $conn->prepare("SELECT * FROM tuya_smart_plug_$tablesSelected");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Format the data
// ...

// Include FPDF library
require('../../../assets/fpdf185/fpdf.php');

// Create the PDF document
$pdf = new FPDF();
$pdf->AddPage(['L']);

// Set font and color for the header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 255);

// Add the header row
$header = array_keys($data[0]);
foreach ($header as $col) {
    if ($col == "id") {
        $pdf->Cell(15, 10, $col, 1);
    } else if ($col == "time") {
        $pdf->Cell(30, 10, $col, 1);
    } else if ($col == "voltage") {
        $pdf->Cell(20, 10, $col, 1);
    } else if ($col == "current") {
        $pdf->Cell(22, 10, $col, 1);
    } else if ($col == "power") {
        $pdf->Cell(22, 10, $col, 1);
    } else if ($col == "electricity") {
        $pdf->Cell(22, 10, $col, 1);
    } else if ($col == "day") {
        $pdf->Cell(15, 10, $col, 1);
    } else if ($col == "week") {
        $pdf->Cell(15, 10, $col, 1);
    } else if ($col == "month") {
        $pdf->Cell(15, 10, $col, 1);
    } else if ($col == "total_electricity") {
        $pdf->Cell(30, 10, $col, 1);
    } else if ($col == "total_cost") {
        $pdf->Cell(25, 10, $col, 1);
    } else if ($col == "carbon_emission") {
        $pdf->Cell(32, 10, $col, 1);
    } else {
        $pdf->Cell(40, 10, $col, 1);
    }
}

$pdf->Ln();

// Set font and color for the content
$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor(0, 0, 0);

// Add the data rows
foreach ($data as $row) {
    $index = 0;
    foreach ($row as $col) {
        if ($index == 0) {
            $pdf->Cell(15, 10, $col, 1);
        } else if ($index == 1) {
            $pdf->Cell(30, 10, $col, 1);
        } else if ($index == 2) {
            $pdf->Cell(20, 10, $col, 1);
        } else if ($index == 3) {
            $pdf->Cell(22, 10, $col, 1);
        } else if ($index == 4) {
            $pdf->Cell(22, 10, $col, 1);
        } else if ($index == 5) {
            $pdf->Cell(22, 10, $col, 1);
        } else if ($index == 6) {
            $pdf->Cell(15, 10, $col, 1);
        } else if ($index == 7) {
            $pdf->Cell(15, 10, $col, 1);
        } else if ($index == 8) {
            $pdf->Cell(15, 10, $col, 1);
        } else if ($index == 9) {
            $pdf->Cell(30, 10, $col, 1);
        } else if ($index == 10) {
            $pdf->Cell(25, 10, $col, 1);
        } else if ($index == 11) {
            $pdf->Cell(32, 10, $col, 1);
        }
        $index++;
    }
    $index = 0;
    $pdf->Ln();
}

// Output the PDF document\
ob_end_clean();
$pdf->Output('export.pdf', 'I');
?>

<body></body>

<script>
    // Define a function to export the PDF
    function downloadPDF(url) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url);
        xhr.setRequestHeader('Content-Type', 'application/pdf');
        xhr.responseType = 'arraybuffer';
        xhr.onload = function() {
            if (xhr.status === 200) {
                var pdf = xhr.response;
                var blob = new Blob([pdf], {
                    type: 'application/pdf'
                });
                var iframe = document.createElement('iframe');
                iframe.src = URL.createObjectURL(blob);
                iframe.style.display = 'none';
                document.body.appendChild(iframe);
            }
        };
        xhr.send();
    }

    var exportLink = document.querySelector('a[href="export.php"]');
    exportLink.addEventListener('click', function(event) {
        event.preventDefault();
        downloadPDF(this.href);
    });
</script>