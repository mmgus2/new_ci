<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/page/Michael Greenhill billy.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Guide to the forest</div>
            </div>
        </div>
    </div>
</header>
<section class="bg-light-gray">
    <div class="container">
        <table id="info_table" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
        <div id="#test_display"></div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var downloadpath = '../../assets/forest_map/';
        var forests = <?php echo json_encode($allforests) ?>;
        var infoData = [];
        var table = $('#info_table').DataTable({
            destroy: true,
            columns: [
                {title: '<div class="green-font">Forest Name</div>'},
                {title: '<div class="green-font">Forest Description</div>'},
                {title: '<div class="green-font">Download Map</div>'}
            ],
            "pagingType": "simple",
            "lengthMenu": [10, 20]
        });
        for(var i = 0; i < forests.length ; i++)
        {
            table.row.add([forests[i].forest_name,forests[i].description,
                '<a href="' + downloadpath + forests[i].forest_id + '.pdf" download>Download</a>']).draw();
            //console.log(infoData[i]);
        }
    });

</script>
