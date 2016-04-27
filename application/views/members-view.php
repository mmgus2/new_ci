<!--header class="location">
    <div class="parallax-window" data-parallax="scroll" data-image-src="../../assets/img/distance_header.jpg">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">How far do you want to explore?</div>
            </div>
        </div>
    </div>
</header-->
<section class="bg-light-gray">
    <div class="container" style="margin-top: 5%">
        Members page <br />
        <?php
            echo "<pre>";
            print_r($this->session->all_userdata());
            echo "</pre>";
        ?>
        <a href="Review/logout">Logout</a>
    </div>
</section>