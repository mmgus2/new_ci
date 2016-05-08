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
                    <button class="sort" data-sort="forest_name">sort by name</button>
                </div>
            </div>
            <ul class="list list-inline row">
                <?php
                for ($i=0; $i < sizeof($allforests); $i++) {
                ?>
                    <li class="col-sm-12 col-md-6">
                        <table class="table-responsive" style="padding: 10px;">
                            <tr>
                                <td>
                                    <img  src="<?php echo base_url() ?>assets/img/forest_images/<?php echo $allforests[$i]['id'] ?>.png"
                                          class="img-responsive" alt="<?php echo $allforests[$i]['name'] ?>" >
                                </td>
                                <td>
                                    <h4><?php echo $allforests[$i]['name'] ?></h4>
                                    <p class="text-muted"><?php echo $allforests[$i]['description'] ?></p>
                                    <p><strong>Recreation sites</strong></p>
                                    <?php
                                    for($j = 0; $j < sizeof($allforests[$i]['sites']); $j++){
                                        ?>
                                        <p class="text-muted"><?php echo $allforests[$i]['sites'][$j]['site_name'] ?></p>
                                        <?php
                                    }
                                    ?>
                                    <p>
                                        <a class="btn btn-default"
                                           href="<?php echo base_url() ?>assets/forest_map/<?php echo $allforests[$i]['id'] ?>.pdf"
                                           role="button" download>Download Map &raquo;
                                        </a>&nbsp;
                                        <a class="btn btn-default"
                                           href="<?php echo base_url() ?>review/<?php echo $allforests[$i]['id'] ?>"
                                           role="button" download>Review &raquo;
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </li>
                    <hr>
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

</script>
