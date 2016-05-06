<script>
    $(this).load(function() {
        detectLocation();
    });
</script>
<style>
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
<section class="bg-light-gray">
    <div class="container">
        <input type="hidden" id="max_distance" />
        <input type="hidden" id="display_mode" value="distance" />
        <!--div class="row">
            <div class="col-sm-12 text-left">
                <h3 class="section-subheading text-muted">Check out our website to know about the victorian forests.</h3>
            </div>
        </div-->
        <div class="panel panel-default">
            <div class="row" style="margin: 10px 0;">
                <div class="col-sm-10 col-sm-offset-1">
                    <div id="input_info" hidden="true"></div>
                </div>
                <div class="col-sm-10 col-sm-offset-1">
                    <input class="form-control" id="input_loc" placeholder="Specify your location" type="text">
                </div>
            </div>
            <div id="controller" hidden="true">
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
                    <select class="form-control" id="unit">
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
            <div class="row row-centered" style="margin: 10px 0;">
                <?php
                    for ($i = 0; $i < sizeof($activity); $i++){
                        ?>
                        <div class="col-sm-1 col-centered">
                            <img src="../../assets/img/buttons/<?php echo $activity[$i]["activity_id"] ?>.png"
                                 alt="<?php echo $activity[$i]["activity_name"] ?>"
                                 class="img-responsive" id="<?php echo $activity[$i]["activity_id"] ?>"
                                 onclick="displayDataActivity(this)"
                            />
                                 <p><?php echo $activity[$i]["activity_name"] ?></p>
                        </div>
                <?php
                    }
                ?>
            </div>
            </div>
        </div>
    </div>
</section>