<style>
    .fb_edge_comment_widget {
        display: none !important;
    }
</style>
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
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <p>Lorem ipsum</p>
        <div class="col-md-12">
            <div class="fb-like" data-href="<?php echo base_url(); ?>facebook/<?php echo $forest_id?>"data-layout="standard"
                 data-action="recommend" data-show-faces="true" data-share="false"></div>
        </div>
        <div class="col-md-12">
            <div class="fb-comments" data-href="<?php echo base_url(); ?>facebook/<?php echo $forest_id?>"
                 width="100%" data-numposts="5"></div>
        </div>
    </div>
</section>