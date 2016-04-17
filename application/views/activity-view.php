<script>
    $(this).load(function() {
        detectLocation();
    });
</script>
<section id="activity" class="bg-light-gray">
    <div class="container">
        <!--input type="hidden" id="max_distance" /-->
        <input type="hidden" id="display_mode" value="activity" />
        <div class="row">
            <div class="col-md-12">
                <header class="location" >
                    <div class="container">
                        <div class="intro-text">
                            <div class="intro-lead-in">What activities interest you?</div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <br />
        <div class="row">
                <div class="col-md-1"></div>
                <div id="activity_button_list"></div>
        </div>
        <br />