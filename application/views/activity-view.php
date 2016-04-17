<script>
    $(this).load(function() {
        detectLocation();
    });
</script>
<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/activity_header.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">What activities interest you?</div>
            </div>
        </div>
    </div>
</header>
    <div class="container">
        <!--input type="hidden" id="max_distance" /-->
        <input type="hidden" id="display_mode" value="activity" />
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
        <div class="row" id="activity_button_list">
            <div class="col-sm-1"></div>
        </div>
        <br />