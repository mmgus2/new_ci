<script>
    $(this).load(function() {
        //detect location
        detectLocation();

        //intialise slider max value = 0
        initRangeSlider(0);

        //initialise input auto complete from google
        initAutocomplete();

        //add clear button (x) inside input auto complete
        $("#input_loc").addClear();
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
                <div class="intro-lead-in">Where do you want to go?</div>
            </div>
        </div>
    </div>
</header>
<!--Menu Section-->
<section class="bg-light-gray">
    <div class="container">
        <input type="hidden" id="max_distance" />
        <input type="hidden" id="activity" />
        <!--div class="row">
            <div class="col-sm-12 text-left">
                <h3 class="section-subheading text-muted">Check out our website to know about the victorian forests.</h3>
            </div>
        </div-->
        <!--div class="panel panel-default"-->
            <div class="row" style="margin: 10px 0;">
                <div class="col-sm-10 col-sm-offset-1">
                    <div id="input_info" hidden="true"></div>
                </div>
                <div class="col-sm-10 col-sm-offset-1">
                    <input class="form-control" id="input_loc" placeholder="Specify your location" type="text">
                </div>
            </div>
        <div id="controller">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <hr />
                </div>
            </div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-sm-8 col-sm-offset-1" >
                    <input type="range" min="0" step="1" id="range_slider">&nbsp;
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
            <div class="row row-centered" style="margin: 10px 0; pointer-events: none; color: grey;"
                 id="activity_button_list">
                <?php
                    for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <div class="col-sm-1 col-centered">
                            <div><img src="../../assets/img/buttons/<?php echo $activity[$i]["activity_id"] ?>.png"
                                 alt="<?php echo $activity[$i]["activity_name"] ?>"
                                 class="img-responsive" id="<?php echo $activity[$i]["activity_id"] ?>"
                                 onclick="acceptActivity(this)"
                            ></div>
                                 <p><?php echo $activity[$i]["activity_name"] ?></p>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<!--Pictures Forest Section-->
<section class="bg-light-gray">
    <div class="container">
    </div>
</section>

<!-- Map Section -->
<section class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="fa-border" id="map" style="width: 100%; height: 600px;"></div>
            </div>
        </div>
        <br />
        <div class="row text-left">
            <div class="col-md-12">
                <strong>Legends</strong>
                <hr>
                <ul class="list-inline">
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
                    for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <li>
                            <img src="../../assets/img/buttons/<?php echo $activity[$i]["activity_id"] ?>.png"
                                 class="img-responsive"
                                 alt="<?php echo $activity[$i]["activity_name"] ?>"
                                 height="20"
                            >
                            <p><?php echo $activity[$i]["activity_name"] ?></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>