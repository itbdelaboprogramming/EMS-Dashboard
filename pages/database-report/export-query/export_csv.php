<?php
include("../../../database/config.php");

$tablesSelected = $_GET['selectedOption'];

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM tuya_smart_plug_$tablesSelected";
$result = mysqli_query($connect, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

$json = json_encode($data);



?>

<body>

</body>


<script>
  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // Create CSV file
    csvFile = new Blob([csv], {
      type: "text/csv"
    });

    // Create download link
    downloadLink = document.createElement("a");

    // Set download link attributes
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";

    // Add download link to page
    

    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
  }

  var csv = JSON.stringify(<?php echo $json; ?>);
  var filename = "data_1.csv";

  downloadCSV(csv, filename);
</script>