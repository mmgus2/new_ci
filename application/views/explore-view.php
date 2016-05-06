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
        <div class="row">
            <div class="col-sm-12 text-left">
                <h3 class="section-subheading text-muted">Check out our website to know about the victorian forests.</h3>
            </div>
        </div>
        <div class="panel panel-default" id="menu_container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="input_info" hidden="true"></div>
                </div>
                <div class="col-sm-12">
                    <input class="form-control" id="input_loc" placeholder="Specify your location" type="text">
                </div>
            </div>
        </div>
    </div>
</section>