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
        <div id="info_list">
            <div class="row row-centered">
                <div class="col-sm-3 col-centered">
                    <input class="search form-control" placeholder="Search forest" id="search_list">
                </div>
                <div class="col-sm-3 col-centered">
                    <button class="btn btn-success sort" data-sort="name">sort by name</button>
                </div>
            </div>
            <ul class="list list-inline row">
                <?php
                for ($i=0; $i < sizeof($allforests); $i++) {
                ?>
                    <li class="col-sm-12 col-md-12">
                        <table class="table-responsive">
                            <tr>
                                <td valign="top" style="padding: 10px;">
                                    <img  src="../../assets/img/forest_images/<?php echo $allforests[$i]['id'] ?>.png"
                                          class="img_src img_alt" alt="<?php echo $allforests[$i]['name'] ?>" >
                                </td>
                                <td valign="top" style="padding: 10px;">
                                    <h4 class="name"><?php echo $allforests[$i]['name'] ?></h4>
                                    <hr>
                                    <p class="text-muted description"><?php echo $allforests[$i]['description'] ?></p>
                                    <p><strong>Recreation sites</strong></p>
                                    <p class="text-muted site_list">
                                    <?php
                                    for($j = 0; $j < sizeof($allforests[$i]['sites']); $j++){
                                        ?>
                                        <?php echo $allforests[$i]['sites'][$j]['site_name'] ?><br />
                                        <?php
                                    }
                                    ?>
                                    </p>
                                    <p>
                                        <a class="btn btn-default download"
                                           href="../../assets/forest_map/<?php echo $allforests[$i]['id'] ?>.pdf"
                                           role="button" download>Download Map &raquo;
                                        </a>&nbsp;
                                        <!--a class="btn btn-default review"
                                           href="<?php //echo base_url() ?>review/<?php //echo $allforests[$i]['id'] ?>"
                                           role="button">Review &raquo;
                                        </a-->
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <hr>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                    <ul class="pagination"></ul>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var paginationOptions = {
            name: "pagination",
            paginationClass: "pagination",
            innerWindow: 3,
            left: 2,
            right: 4
        };
        var listOptions = {
            valueNames: [ {attr:'src',name:'img_src'},
                {attr:'alt',name:'img_alt'},
                'name',
                'description',
                'site_list',
                {attr:'href',name:'download'},
                'forest_name'
                //{attr:'href',name:'review'}
            ],
            page: 5,
            plugins: [
                ListPagination(paginationOptions)
            ]
        };
        //global initalisation
        var infoList = new List('info_list', listOptions);

        $('#search_list').addClear({
            onClear: function () {
                infoList.search();
            }
        });
    })
</script>
