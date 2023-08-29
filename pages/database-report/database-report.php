<head>
    <link rel="stylesheet" href="./pages/database-report/database-report.css">
</head>

<div class="lds-dual-ring" id="loadingContainer"></div>
<div id="database-report" class="tabcontent daily_report" style="display: none;">
    <div class="" style="display:flex">
        <div class="smartplug-options">
            <select class="smartplug-toggle" data-target=".table-section" id="smartplugSelect">
                <option value="">--Please choose an option--</option>
                <option value="1" data-show=".Smartplug-1">Delabo Computer-1</option>
                <option value="2" data-show=".Smartplug-2">Delabo Computer-2</option>
                <option value="3" data-show=".Smartplug-3">Delabo Computer-3</option>
                <option value="4" data-show=".Smartplug-4">Delabo Computer-4</option>
                <option value="5" data-show=".Smartplug-5">Refrigerator</option>
                <option value="6" data-show=".Smartplug-6">Dispenser</option>
                <option value="7" data-show=".Smartplug-7">TV</option>
                <option value="8" data-show=".Smartplug-8">3D Print</option>
            </select>
        </div>
        <div>
            <div class="export-button-section" id="export-1" style="display:flex">
                <a href="./pages/database-report/export-query/export_csv.php?selectedOption=" id="csvExportButton"
                    target="_blank" class="export-button">CSV</a>
                <a href="./pages/database-report/export-query/export_excel.php?selectedOption=" id="excelExportButton"
                    target="_blank" class="export-button">Excel</a>
                <a href="./pages/database-report/export-query/export_pdf.php?selectedOption=" id="pdfExportButton"
                    target="_blank" class="export-button">PDF</a>
            </div>
        </div>
    </div>

    <div class="container">
        <table id='empTable' class='display dataTable'>
            <thead>
                <tr>
                    <th>id</th>
                    <th>time</th>
                    <th>voltage</th>
                    <th>current</th>
                    <th>power</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script>
    var refreshId;
    var firstLoad = true;
    var dataTable;

    showLoading();

    function tableMaker(number) {
        dataTable = $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false,
            'ajax': {
                'url': "./pages/database-report/ajaxfile.php?selectedOption=" + number,
                'data': function (requestData) {
                    requestData.searchByGender = $('#searchByGender').val();
                    requestData.searchByName = $('#searchByName').val();
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'time' },
                { data: 'voltage' },
                { data: 'current' },
                { data: 'power' },
            ]
        });

        $('#searchByName').keyup(function () {
            dataTable.draw();
        });

        $('#searchByGender').change(function () {
            dataTable.draw();
        });
    }

    function renderTable(number) {
        $("#empTable").dataTable().fnDestroy();

        tableMaker(number);
    }

    function showLoading() {
        $('#loadingContainer').show();
    }

    function hideLoading() {
        $('#loadingContainer').hide();
        document.getElementById('database-report').style.display='block'
    }

    $(document).ready(function () {
        setTimeout(function () {
            tableMaker(1);
            if (firstLoad) {
                hideLoading();
                firstLoad = false;
            }
        }, 10000);

        // $('.smartplug-toggle').on('change', function () {
        //     var number = $(this).val();
        //     renderTable(number);
        // });
    });

    // Bagian JavaScript
    var csvExportButton = document.getElementById("csvExportButton");
    var excelExportButton = document.getElementById("excelExportButton");
    var pdfExportButton = document.getElementById("pdfExportButton");
    
    var smartplugSelect = document.getElementById("smartplugSelect");

    smartplugSelect.addEventListener("change", function () {
        var selectedOption = smartplugSelect.value;
        csvExportButton.href = "./pages/database-report/export-query/export_csv.php?selectedOption=" + selectedOption;
        excelExportButton.href = "./pages/database-report/export-query/export_excel.php?selectedOption=" + selectedOption;
        pdfExportButton.href = "./pages/database-report/export-query/export_pdf.php?selectedOption=" + selectedOption;

        renderTable(selectedOption);
    });
</script>