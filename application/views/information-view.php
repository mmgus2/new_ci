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
        <div id="forest_list" hidden="true">
            <div class="row row-centered">
                <div class="col-sm-3 col-centered">
                    <input class="search form-control" placeholder="Search forest" id="search_list">
                </div>
                <div class="col-sm-3 col-centered">
                    <button class="sort" data-sort="forest_name">sort by name</button>
                </div>
            </div>
            <ul class="list row">
                <?php
                for ($i=0; $i < sizeof($allforests); $i++) {
                ?>
                    <li class="col-sm-12 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3" style= "background-color:white" >
                                <img  src="<?php echo base_url() ?>asset/img/forest_images/<?php echo $allforests['id'] ?>.png"
                                      class="img-responsive" alt="<?php echo $allforests['name'] ?>" >
                            </div>
                            <div class="col-sm-6 col-md-3" style= "background-color:white" >
                                <h4><?php echo $allforests['name'] ?></h4>
                                <hr>
                                <p class="text-muted"><?php echo $allforests['description'] ?></p>
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
                                      href="<?php echo base_url() ?>asset/forest_map/<?php echo $allforests['id'] ?>.pdf"
                                      role="button" download>Download Map &raquo;
                                    </a>&nbsp;
                                    <a class="btn btn-default"
                                       href="<?php echo base_url() ?>review/<?php echo $allforests['id'] ?>"
                                       role="button" download>Review &raquo;
                                    </a>
                                </p>
                            </div>
                        </div>
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

</script>
