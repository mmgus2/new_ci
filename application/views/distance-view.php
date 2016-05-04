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
                <div class="intro-lead-in">How far do you want to explore?</div>
            </div>
        </div>
    </div>
</header>
<section class="bg-light-gray">
    <div class="container">
        <input type="hidden" id="max_distance" />
        <input type="hidden" id="display_mode" value="distance" />
        <div class="row">
            <div class="col-md-5">
                <div id="input_info" hidden="true"></div>
                <input class="form-control" id="input_loc" placeholder="Specify your location" type="text">
            </div>
            <div class="col-md-7">
                <b>Scroll to get preferred distance</b>
                <br />
                <br />
                <input type="range" min="0" step="1" id="range_slider">&nbsp;
                <br />
                Distance unit: &nbsp;
                <select class="form-control" id="unit">
                    <option value="K" selected>Km</option>
                    <option value="M">Mile</option>
                </select>
            </div>
        </div>
        <br />