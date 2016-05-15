<script>
    $(this).load(function() {
        //detect location
        detectLocation();

        //intialise slider max value = 0
        initRangeSlider(0);

        //initialise input auto complete from google
        initAutocomplete();

        //add clear button (x) inside input
        $("#input_loc").addClear();
        $('#search_list').addClear({
            onClear: function () {
                forestList.search();
            }
        });

    });
</script>
<style>
    /*remove clear button (x) in Internet Explorer*/
    ::-ms-clear {display: none; width:0; height:0;}
</style>
<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/distance_header.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Find forest near you</div>
            </div>
        </div>
    </div>
</header>
<!--Menu Section-->
<section id="menu_map" class="bg-light-gray">
    <div class="container">
        <!--div class="row">
            <div class="col-sm-12 text-left">
                <h3 class="section-subheading text-muted">Check out our website to know about the victorian forests.</h3>
            </div>
        </div-->
        <!--div class="panel panel-default"-->
            <div class="row" style="margin: 10px 0;">
                <div id="info_container" class="col-sm-10 col-sm-offset-1" hidden="true">
                    <div id="input_info" style="text-align: center;"></div>
                    <br />
                    <input class="form-control" id="input_loc"
                           placeholder="Enter your location" type="text">
                </div>
            </div>
            <div id = "return_forest" hidden="true" class="row" style="margin: 10px 0;">
                <div class="col-sm-10 col-sm-offset-1" style="text-align: center">
                    <button class="btn btn-success" onclick="backToForest()">Return to Forest List</button>
                </div>
            </div>
        <div id="menu_container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <hr />
                </div>
            </div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-sm-8 col-sm-offset-1" >
                    <input type="range" min="0" step="1" id="range_slider" disabled>&nbsp;
                </div>
                <div class="col-sm-2" style="position: relative; top: -5px;">
                    <select class="form-control" id="unit" disabled>
                        <option value="K" selected>Km</option>
                        <option value="M">Mile</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <hr />
                </div>
            </div>
            <!--div class="row row-centered" style="margin: 10px 0; pointer-events: none; color: grey;"
                 id="activity_button_list">
                <?php
                    for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <div class="col-sm-1 col-centered">
                            <p><img src="../../assets/img/buttons/<?php echo $activity[$i]["activity_id"] ?>.png"
                                 alt="<?php echo $activity[$i]["activity_name"] ?>"
                                 class="img-responsive" id="<?php echo $activity[$i]["activity_id"] ?>"
                                 onclick="acceptActivity(this)"
                            ></p>
                                 <p><?php echo $activity[$i]["activity_name"] ?></p>
                        </div>
                <?php
                    }
                ?>
            </div-->
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 table-responsive">
            <table class="table" style="margin: 10px 0; pointer-events: none; color: grey; text-align: center;"
                 id="activity_button_list">
                <tr>
                <?php
                for ($i = 0; $i < sizeof($activity); $i++){
                    ?>
                    <td>
                        <img src="../../assets/img/buttons/<?php echo $activity[$i]["activity_id"] ?>.png"
                             alt="<?php echo $activity[$i]["activity_name"] ?>"
                             class="img-responsive img-button img-responsive-icon" id="<?php echo $activity[$i]["activity_id"] ?>"
                             onclick="acceptActivity(this)"
                             style="margin: 0 auto"
                        >
                    </td>
                    <?php
                }
                ?>
                </tr>
                <tr>
                    <?php
                    for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <td>
                            <?php echo $activity[$i]["activity_name"] ?>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
                    </div>
                </div>
        </div>
    </div>
    <!-- Map Section and list -->
    <div id="map_section" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div id="list_info_container" class="col-sm-12 alert alert-warning">
                    <span id="list_info"</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="fa-border" id="map"
                         style="width: 100%; height: 600px;
                     background:url(../../assets/img/ajax-loader.gif) no-repeat center center;">
                        <!--img src="../../assets/img/ajax-loader.gif" style="display:block; margin:auto auto;" /-->
                    </div>
                </div>
                <div class="col-sm-1">
                    <strong>Legends</strong>
                    <hr>
                    <ul style="margin-top: 10px; list-style-type:none; padding-left: 0;">
                        <li>
                            <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|7CC37C|000000"
                                 alt="Forest legend"
                            >
                            <p>Forest</p>
                        </li>
                        <li>
                            <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|FFDE00|000000"
                                 alt="Recreation site legend"
                            >
                            <p>Recreation Site</p>
                        </li>
                        <?php
                        //for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <!--li>
                            <img src="../../assets/img/buttons/<?php //echo $activity[$i]["activity_id"] ?>.png"
                                 class="img-responsive"
                                 alt="<?php //echo $activity[$i]["activity_name"] ?>"
                                 height="20"
                            >
                            <p><?php //echo $activity[$i]["activity_name"] ?></p>
                        </li-->
                        <?php
                        //}
                        ?>
                    </ul>
                </div>
            </div>
            <br />
            <div class="row" id="iframe_container" hidden="true">
                <div class="col-sm-12">
                    <iframe id="iframe" width="100%" height="600">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Pictures Forest Section-->
<section id="portfolio" class="bg-light-gray forest_section" hidden="true">
    <div class="container">
        <div class="col-sm-12">
            <div id="forest_list" hidden="true">
                <div class="row row-centered">
                    <div class="col-sm-6 col-centered">
                        <input class="search form-control" placeholder="Search forest" id="search_list">
                    </div>
                </div>
                <br />
                <div class="row row-centered">
                    <div class="col-sm-6 col-centered" style="text-align: center">
                        <button class="btn btn-success sort" data-sort="forest_name">sort by name</button>
                        <button class="btn btn-success sort" data-sort="distance">sort by distance</button>
                    </div>
                </div>
                <hr>
                <!--div class="row" style="text-align: center"-->
                <ul class="list list-inline row"></ul>
                <span class="not_found">No forest exist with that name</span>
                <!--/div-->
                <div class="row">
                    <div class="col-sm-12" style="text-align: center;">
                        <ul class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>