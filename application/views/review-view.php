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
<style>
    /*style for weather*/
    @font-face {
        font-family: 'weather';
        src: url('../../assets/fonts/artill_clean_icons.otf');
        src: url('../../assets/fonts/artill_clean_icons.otf?#iefix') format('embedded-opentype'),
        url('../../assets/fonts/artill_clean_icons.otf') format('woff'),
        url('../../assets/fonts/artill_clean_icons.otf') format('truetype'),
        url('../../assets/fonts/artill_clean_icons.otf') format('svg');
        font-weight: normal;
        font-style: normal;
    }

    #weather {
        /*margin: 0px auto;*/
        margin: 0px;
        text-align: center;
        text-transform: uppercase;
        background-image: url(../../assets/img/forest_images/<?php echo $aforest["id"]; ?>.png);
        background-size: cover;
    }

    i {
        color: #fff;
        font-family: weather;
        font-size: 150px;
        font-weight: normal;
        font-style: normal;
        line-height: 1.0;
        text-transform: none;
    }

    .icon-0:before { content: ":"; }
    .icon-1:before { content: "p"; }
    .icon-2:before { content: "S"; }
    .icon-3:before { content: "Q"; }
    .icon-4:before { content: "S"; }
    .icon-5:before { content: "W"; }
    .icon-6:before { content: "W"; }
    .icon-7:before { content: "W"; }
    .icon-8:before { content: "W"; }
    .icon-9:before { content: "I"; }
    .icon-10:before { content: "W"; }
    .icon-11:before { content: "I"; }
    .icon-12:before { content: "I"; }
    .icon-13:before { content: "I"; }
    .icon-14:before { content: "I"; }
    .icon-15:before { content: "W"; }
    .icon-16:before { content: "I"; }
    .icon-17:before { content: "W"; }
    .icon-18:before { content: "U"; }
    .icon-19:before { content: "Z"; }
    .icon-20:before { content: "Z"; }
    .icon-21:before { content: "Z"; }
    .icon-22:before { content: "Z"; }
    .icon-23:before { content: "Z"; }
    .icon-24:before { content: "E"; }
    .icon-25:before { content: "E"; }
    .icon-26:before { content: "3"; }
    .icon-27:before { content: "a"; }
    .icon-28:before { content: "A"; }
    .icon-29:before { content: "a"; }
    .icon-30:before { content: "A"; }
    .icon-31:before { content: "6"; }
    .icon-32:before { content: "1"; }
    .icon-33:before { content: "6"; }
    .icon-34:before { content: "1"; }
    .icon-35:before { content: "W"; }
    .icon-36:before { content: "1"; }
    .icon-37:before { content: "S"; }
    .icon-38:before { content: "S"; }
    .icon-39:before { content: "S"; }
    .icon-40:before { content: "M"; }
    .icon-41:before { content: "W"; }
    .icon-42:before { content: "I"; }
    .icon-43:before { content: "W"; }
    .icon-44:before { content: "a"; }
    .icon-45:before { content: "S"; }
    .icon-46:before { content: "U"; }
    .icon-47:before { content: "S"; }

    #weather h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 100px;
        font-weight: 300;
        /*text-align: center;*/
        text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
    }

    #weather ul {
        margin: 0;
        padding: 0;
    }

    #weather li {
        background: #fff;
        background: rgba(255,255,255,0.90);
        /*padding: 20px;*/
        padding: 5px;
        display: inline-block;
        border-radius: 5px;
    }

    #weather .currently {
        margin: 0 20px;
    }
</style>
<section class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div id="weather"> </div>
            </div>
        </div>

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