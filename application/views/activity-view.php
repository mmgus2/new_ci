<script>
    $(this).load(function() {
        detectLocation();
    });
</script>
<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/activity_header.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in white-font">What activities interest you?</div>
            </div>
        </div>
    </div>
</header>
<section class="bg-light-gray">
    <div class="container">
        <!--input type="hidden" id="max_distance" /-->
        <input type="hidden" id="display_mode" value="activity" />
        <div class="row">
            <div class="col-md-12">
                <b>Select one or more activites</b>
            </div>
        </div>
        <div class="row">
            <br />
            <span id="activity_button_list"></span>
            <br />
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="input_info" hidden="true"></div>
                <input class="form-control" id="input_loc" placeholder="Specify your location" type="text">
            </div>
            <div class="col-md-6">
                Distance unit: &nbsp;
                <select class="form-control" id="unit">
                    <option value="K" selected>Km</option>
                    <option value="M">Mile</option>
                </select>
            </div>
        </div>
        <!--div class="row">
            <div class="col-md-12">
                <header class="location" >
                    <div class="container">
                        <div class="intro-text">
                            <div class="intro-lead-in">What activities interest you?</div>
                        </div>
                    </div>
                </header>
            </div>
        </div-->
        <br />
        <br />