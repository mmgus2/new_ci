<script>
    $(this).load(function() {
        detectLocation();
    });
</script>
<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/distance_header.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">How Far would you Explore?</div>
            </div>
        </div>
    </div>
</header>
    <div class="container">
        <input type="hidden" id="max_distance" />
        <input type="hidden" id="display_mode" value="distance" />
        <!--div class="row">
            <div class="col-md-12">
                <header class="location" >
                    <div class="container">
                        <div class="intro-text">
                            <div class="intro-lead-in">How Far would you Explore?</div>
                        </div>
                    </div>
                </header>
            </div>
        </div-->
        <!--div class="row">
            <div class="col-md-4">
                <h5>How far would you explore?</h5>
            </div>
        </div-->
        <div class="row">
            <div class="col-md-12">
                <br />
                <input type="range" value="0" min="0" step="1">
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-2">
                <select class="form-control" id="unit">
                    <option value="K" selected>Km</option>
                    <option value="M">Mile</option>
                </select>
            </div>
        </div>
        <br />