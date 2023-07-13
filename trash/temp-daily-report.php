<div id="database-report" class="tabcontent" style="display:none;">
    <div class="title-table-section">
        <div class="smartplug-options">
            <select class="smartplug-toggle" data-target=".table-section">
                <option value="1" selected data-show=".Smartplug-1">Smartplug - 1</option>
                <option value="2" data-show=".Smartplug-2">Smartplug - 2</option>
                <option value="3" data-show=".Smartplug-3">Smartplug - 3</option>
                <option value="4" data-show=".Smartplug-4">Smartplug - 4</option>
                <option value="5" data-show=".Smartplug-5">Smartplug - 5</option>
                <option value="6" data-show=".Smartplug-6">Smartplug - 6</option>
                <option value="7" data-show=".Smartplug-7">Smartplug - 7</option>
                <option value="8" data-show=".Smartplug-8">Smartplug - 8</option>
            </select>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive" id="data"></div>
    </div>
</div>
<script>

    function tableMaker(number) {
        function load_data(page) {
            $.ajax({
                url: `./assets/new-pagination/data${number}.php`,
                method: "POST",
                data: {
                    page: page
                },
                success: function(data) {
                    $('#data').html(data);
                }
            })
        }

        $(document).on('click', '.halaman', function() {
            var page = $(this).attr("id");
            load_data(page);
        });
        load_data()
    }

    $(document).ready(function() {
        $('.smartplug-toggle').on('change', function() {
            var dataDiv = $('#data');
            console.log("HHH", dataDiv);

            // Use the remove() method to remove the 'data' div and all its child elements
            // dataDiv.remove();

            var demovalue = $(this).val();
            // $("div.chartContainer").hide();
            // $("#responsecontainer" + demovalue).show();
            if (demovalue == 1) {
                tableMaker(1)
            }
            if (demovalue == 2) {
                tableMaker(2)
            }
        });
    });
</script>