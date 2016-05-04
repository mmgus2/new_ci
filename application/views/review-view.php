<header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/page/Michael Greenhill billy.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Guide to the forest</div>
            </div>
        </div>
    </div>
</header>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=597150270432127";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<section class="bg-light-gray">
    <div class="container">
        <div id="weather" style="background-image: url(../../assets/img/forest_images/<?php echo $aforest["id"]; ?>.png);
            background-size: cover;"> </div>

        <div>
            <h4><?php echo $aforest["name"]; ?></h4>
            <hr>
            <p class="text-muted"><?php echo $aforest["description"]; ?></p>
            <p class="text-muted">
                <strong>Recreation Sites</strong><br />
                <ul>
                <?php
                    for ($i = 0; $i < sizeof($aforest["sites"]); $i++){
                        echo '<li>' . $aforest["sites"][$i]["site_name"] . '</li>';
                    }
                ?>
                </ul>
            </p>
            <p class="text-muted">
                <strong>Activites</strong><br />
            <ul>
                <?php
                for ($i = 0; $i < sizeof($aforest["activities"]); $i++){
                    echo '<li>' . $aforest["activities"][$i]["activity_name"] . '</li>';
                }
                ?>
            </ul>
            </p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="fb-like" data-href="<?php echo base_url(); ?>review/<?php echo $aforest["id"]?>"data-layout="standard"
                     data-action="recommend" data-show-faces="true" data-share="false"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="fb-comments" data-href="<?php echo base_url(); ?>review/<?php echo $aforest["id"]?>"
                     width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>
</section>
<script>
    // v3.1.0
    //Docs at http://simpleweatherjs.com
    $(document).ready(function() {
        $.simpleWeather({
            location: '<?php echo $aforest["latitude"]?>, <?php echo $aforest["longitude"]?>',
            unit: 'c',
            success: function(weather) {
                html = '<h2><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
                html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
                html += '<li class="currently">'+weather.currently+'</li>';
                //html += '<li>'+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</li></ul>';

                $("#weather").html(html);
            },
            error: function(error) {
                $("#weather").html('<p>'+error+'</p>');
            }
        });
    });
</script>