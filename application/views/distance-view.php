<script>
    $(this).load(function() {
        detectLocation();
    });
</script>

<section id="loc_distance" class="bg-light-gray">
    <div class="container">
        <input type="hidden" id="latitude" />
        <input type="hidden" id="longitude" />
        <input type="hidden" id="max_distance" />
        <input type='hidden' id='f_current_page' />
        <input type='hidden' id='s_current_page' />
        <div class="row">
            <div class="col-md-4">
                <h5>How far would you explore?</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="range" value="0" min="0" step="1">
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-2">
                <select class="form-control" id="unit">
                    <option value="K" selected>Km</option>
                    <option value="M">Mile</option>
                </select>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6">
                <div id="aforest_container" hidden="true">
                </div>
                <div id="f_table_container">
                    <table id="f_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    </table>
                </div>
                <div id="s_table_container" hidden="true">
                    <table id="s_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="fa-border" id="map" style="width: 100%; height: 500px;"></div>
            </div>
            <br />
        </div>
        <br /><br />
    </div>
</section>