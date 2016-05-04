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
        <table id="info_table" class="table table-striped" cellspacing="0" width="100%"></table>
        <div id="#test_display"></div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var downloadpath = '../../assets/forest_map/';
        var imagepath = '../../assets/img/forest_images/';
        var baseUrl = window.location.protocol + "//" + window.location.host + "/";
        //var baseUrl = "http://localhost/index.php/";

        var forests = <?php echo json_encode($allforests) ?>;
        var table = $('#info_table').DataTable({
            destroy: true,
            columns: [
                {title: '<div class="green-font">Forest</div>'},
                {title: '<div class="green-font">Recreation sites</div>'},
                {title: '<div class="green-font">Further Actions</div>'}
            ],
            "columns": [
                null,
                { "orderable": false },
                { "orderable": false },
                ],
            "pagingType": "simple",
            "lengthMenu": [5, 10]
        });
        for(var i = 0; i < forests.length ; i++)
        {
            var firstColumn = '<div>';
            firstColumn += '<img src="' + imagepath + forests[i].id + '.png" class="img-responsive" alt="'
            + forests[i].name +'">';
            firstColumn += '</div>';
            firstColumn += '<div>';
            firstColumn += '<h4>' + forests[i].name + '</h4>';
            firstColumn += '<hr>';
            firstColumn += '<p class="text-muted">' + forests[i].description + '</p>';
            var secondColumn = '<p class="text-muted"><strong>Recreation Sites</strong></p>';
                secondColumn += '<ul>';
            for(var j = 0; j < forests[i].sites.length; j++){
                secondColumn += '<li>' + forests[i].sites[j].site_name + '</li>';
            }
            secondColumn += '</ul>';
            thirdColumn = '<p><a href="' + downloadpath + forests[i].id + '.pdf" download>Download Map</a></p>';
            thirdColumn += '<p><a href="' + baseUrl + 'review/' + forests[i].id +'">Review Forest</a></p>';
            table.row.add([firstColumn,secondColumn, thirdColumn]).draw();
            //console.log(infoData[i]);
        }
    });

</script>
