<?php

// Reference. ChatGpt : how to make a link, that can directly export database to csv format using php and javascript

include('./database/config.php');

// require_once('./assets/Tcpdf.php');

$upper1  = mysqli_query($connect, 'SELECT id,time,voltage,current,power,electricity,day,week,month FROM tuya_smart_plug_1 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 50 ');
$under1 = mysqli_query($connect, 'SELECT total_electricity,total_cost,carbon_emission FROM tuya_smart_plug_1 WHERE total_electricity IS NOT NULL ORDER BY id DESC LIMIT 50');

$upper2 = mysqli_query($connect, 'SELECT id,time,voltage,current,power,electricity,day,week,month FROM tuya_smart_plug_2 WHERE voltage IS NOT NULL ORDER BY id DESC LIMIT 50');
$under2 = mysqli_query($connect, 'SELECT total_electricity,total_cost,carbon_emission FROM tuya_smart_plug_2 WHERE total_electricity IS NOT NULL ORDER BY id DESC LIMIT 50');

?>

<center>
  <!-- <a target="_blank" href="./components/export_excel.php">EXPORT KE EXCEL</a> -->
  <!-- <a target="_blank" href="./components/export_csv.php">EXPORT KE CSV</a> -->
  <a target="_blank" href="./components/export_pdf.php">Export to PDF</a>
</center>
<div id="database-report" class="tabcontent" style="display:none;">
  <div class="title-table-section">
    <div class="smartplug-options">
      <select class="smartplug-toggle" data-target=".table-section">
        <option value="Smartplug-1" selected data-show=".Smartplug-1">Smartplug - 1</option>
        <option value="Smartplug-2" data-show=".Smartplug-2">Smartplug - 2</option>
        <option value="Smartplug-3" data-show=".Smartplug-3">Smartplug - 3</option>
        <option value="Smartplug-4" data-show=".Smartplug-4">Smartplug - 4</option>
        <option value="Smartplug-5" data-show=".Smartplug-5">Smartplug - 5</option>
        <option value="Smartplug-6" data-show=".Smartplug-6">Smartplug - 6</option>
        <option value="Smartplug-7" data-show=".Smartplug-7">Smartplug - 7</option>
        <option value="Smartplug-8" data-show=".Smartplug-8">Smartplug - 8</option>
      </select>
    </div>
  </div>
  <section class="container">
    <div class="panel">
      <div class="body">
        <div class="input-group">
          <label for="searchBox">Search</label>
          <input type="search" id="searchBox" placeholder="Search By Value">
        </div>
      </div>
    </div>
    <table id="table" class="myTable table hover">
      <thead>
        <tr>
          <th>id</th>
          <th>Time</th>
          <th>Voltage</th>
          <th>Current</th>
          <th>Power</th>
          <th>Electricity</th>
          <th>Day</th>
          <th>Week</th>
          <th>Month</th>
          <th>Total Electricity</th>
          <th>Total Cost</th>
          <th>Carbon Emission</th>
        </tr>
      </thead>
      <tbody id="theData">
      </tbody>
    </table>
    <?php
    ?>

  </section>
</div>

<script>
  var dataUpper = [];
  var dataUnder = [];
  let fusionData = []

  var dataUpper1 = [];
  var dataUnder1 = [];

  var dataUpper2 = [];
  var dataUnder2 = [];
</script>

<?php
$user_arr = array();
while ($upper = mysqli_fetch_assoc($upper1)) {
  $data_upper[] = array($upper['id'], $upper['time'], $upper['voltage'], $upper['current'], $upper['power'], $upper['electricity'], $upper['day'], $upper['week'], $upper['month'])
?>
  <script>
    dataUpper1.push([<?php echo $upper['id']; ?>, <?php echo '"' . $upper['time'] . '"'; ?>, <?php echo $upper['voltage']; ?>, <?php echo $upper['current']; ?>, <?php echo $upper['power']; ?>, <?php echo $upper['electricity']; ?>, <?php echo $upper['day']; ?>, <?php echo $upper['week']; ?>, <?php echo $upper['month']; ?>])
  </script>
<?php
}
?>

<?php
while ($under = mysqli_fetch_assoc($under1)) {
  $data_under[] = array($under['total_electricity'], $under['total_cost'], $under['carbon_emission'])
?>
  <script>
    dataUnder1.push([<?php echo $under['total_electricity']; ?>, <?php echo '"' . $under['total_cost'] . '"'; ?>, <?php echo $under['carbon_emission']; ?>])
  </script>
<?php
}
?>

<?php
while ($upper = mysqli_fetch_assoc($upper2)) {
?>
  <script>
    dataUpper2.push([<?php echo $upper['id']; ?>, <?php echo '"' . $upper['time'] . '"'; ?>, <?php echo $upper['voltage']; ?>, <?php echo $upper['current']; ?>, <?php echo $upper['power']; ?>, <?php echo $upper['electricity']; ?>, <?php echo $upper['day']; ?>, <?php echo $upper['week']; ?>, <?php echo $upper['month']; ?>])
  </script>
<?php
}
?>

<?php
while ($under = mysqli_fetch_assoc($under2)) {
?>
  <script>
    dataUnder2.push([<?php echo $under['total_electricity']; ?>, <?php echo '"' . $under['total_cost'] . '"'; ?>, <?php echo $under['carbon_emission']; ?>])
  </script>
<?php
}
?>


<script>
  var smartplugStatus

  if (document.getElementById("theData").childElementCount == 0) {
    tableRender(dataUpper1, dataUnder1)
  }

  $('select').on('change', function() {
    smartplugStatus = this.value
    if (smartplugStatus == 'Smartplug-1') {
      tableRender(dataUpper1, dataUnder1)
    } else if (smartplugStatus == 'Smartplug-2') {
      tableRender(dataUpper2, dataUnder2)
    }
  });


  function tableRender(dataUpper, dataUnder) {
    if (!document.getElementById("theData")) {
      var tableBodyMaker = document.createElement('tbody');
      tableBodyMaker.id = "theData"
      document.getElementById("table").appendChild(tableBodyMaker)
    }
    document.getElementById("theData").innerHTML = ""

    if (fusionData.length > 0) {
      fusionData = []
    }

    dataUpper.map((value, index) => {
      fusionData.push(value.concat(dataUnder[index]))
    })
    var tableData = "";
    fusionData.forEach(data => {
      tableData += "<tr>";
      tableData += `<td>${data[0]}</td>`
      tableData += `<td>${data[1]}</td>`
      tableData += `<td>${data[2]}</td>`
      tableData += `<td>${data[3]}</td>`
      tableData += `<td>${data[4]}</td>`
      tableData += `<td>${data[5]}</td>`
      tableData += `<td>${data[6]}</td>`
      tableData += `<td>${data[7]}</td>`
      tableData += `<td>${data[8]}</td>`
      tableData += `<td>${data[9]}</td>`
      tableData += `<td>${data[10]}</td>`
      tableData += `<td>${data[11]}</td>`
      tableData += "</tr>"
    });
    document.getElementById("theData").innerHTML = tableData;

    let options = {
      numberPerPage: 10, //Cantidad de datos por pagina
      goBar: true, //Barra donde puedes digitar el numero de la pagina al que quiere ir
      pageCounter: true, //Contador de paginas, en cual estas, de cuantas paginas
    };

    let filterOptions = {
      el: '#searchBox' //Caja de texto para filtrar, puede ser una clase o un ID
    };


    // window.paginate = lignePaginate();
    paginate.init('.myTable', options, filterOptions);
  }
</script>