<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="../../assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-3.jpg" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>State Forests of Victoria</h1>
                    <p>Search for the nearest state forests. Explore the greenery, peace and adventures.</p>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo base_url();?>Explore" role="button">Explore</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="../../assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-2.jpg" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Indulge in Adventure</h1>
                    <p>Know about the different kind of activities that can be done in state forests.</p>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo base_url();?>Explore" role="button">Explore</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="../../assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-1.jpg" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <!--h1>Give us your Feedback</h1>
                    <p>Tell us your opinion about places, activities and more.</p>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo base_url();?>Information" role="button">Info</a></p-->
                    <h1>Give us your Feedback</h1>
                    <p>Tell us your opinion about places, activities and more.</p>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo base_url();?>Information" role="button">Info</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Explore</h2>
                <h3 class="section-subheading text-muted">Check out our website to know about the victorian forests.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="<?php echo base_url();?>Information" class="portfolio-link">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="../../assets/theme/startbootstrap-agency-1.0.6/img/portfolio/KnowyourForest.jpg" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Know Your Forest</h4>
                    <p class="text-muted">Victorian Forest</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="<?php echo base_url();?>Explore" class="portfolio-link">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="../../assets/theme/startbootstrap-agency-1.0.6/img/portfolio/location.jpg" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Search the Location</h4>
                    <p class="text-muted">Select the Forest you want to visit.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="<?php echo base_url();?>Explore" class="portfolio-link">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="../../assets/theme/startbootstrap-agency-1.0.6/img/portfolio/activities.jpg" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Activities</h4>
                    <p class="text-muted">Explore the Activities for the Forest</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" style="padding-top:100px;padding-bottom:150px" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Forests In Victoria</h2>
                <h3 class="section-subheading text-muted">Explore your way to Forests of Victoria</h3>
            </div>
        </div>
        <div style="background-color:white">
            <div class="row text-left">
                <div class="col-md-5">
                    <img  src="../../assets/img/1027.png" class="img-responsive" alt="Generic placeholder image" >


                </div>

                <div class="col-md-6 " style="text-align:justify">
                    <h4>Forests of Victoria</h4>
                    <hr>
                    <p class="text-muted">Victoria has many forests and hundreds of recreation sites. They are closer to nature and wonderful getaways from the hustle bustle of the city. In this site, we aim to provide you with the information of such hidden gems. You can explore through the functions of location, activities and information to gain the knowledge of such places and how to land there.
                    </p>
                    <p class="text-muted"> This is one stop place to have everything you need for the next forest travel. Explore the comforts of nature packed with adventures.</p>
                    <p><a class="btn btn-default" href="<?php echo base_url() ?>aboutus" role="button">Our Journey &raquo;</a></p>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Team Section>
<section id="team" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Our Amazing Team</h2>
                <h3 class="section-subheading text-muted">Meet the faces behind this application.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="team-member">
                    <img src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/team/navjot.jpg"); ?>" class="img-responsive img-circle" alt="">
                    <h4>Navjot Kaur</h4>
                    <p class="text-muted">Lead Designer</p>
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="team-member">
                    <img src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/team/gus.jpg"); ?>" class="img-responsive img-circle" alt="">
                    <h4>Gus</h4>
                    <p class="text-muted">Lead Developer</p>
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="team-member">
                    <img src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/team/wade.jpg"); ?>" class="img-responsive img-circle" alt="">
                    <h4>Wade</h4>
                    <p class="text-muted">Database Expert</p>
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="team-member">
                    <img src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/team/frank.jpg"); ?>" class="img-responsive img-circle" alt="">
                    <h4>Frank</h4>
                    <p class="text-muted">Data and Stastical Analyst</p>
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <p class="large text-muted">We are working towards development of better applications that make difference to the well being of the community.</p>
            </div>
        </div>
    </div>
</section>

<!-- Clients Aside-->
<aside class="clients">
    <div class="container">
        <div class="row">
            <!--div class="col-md-4">
                <a href="#">
                    <img src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/logos/pwc.png"); ?>" class="img-responsive img-centered" alt="">
                </a>
            </div-->
            <div class="col-md-4 col-md-offset-2">
                <a href="#">
                    <img src="../../assets/theme/startbootstrap-agency-1.0.6/img/logos/deltasolutions.png" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <img src="../../assets/theme/startbootstrap-agency-1.0.6/img/logos/monash.jpg" class="img-responsive img-centered" alt="">
                </a>
            </div>
        </div>
    </div>
</aside>

<!-- Contact Section>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-xl">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->

<!-- Portfolio Modal 1>
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here>
                        <h2>Explore the Forests</h2>
                        <p class="item-intro text-muted">Seelect various forests to get the information</p>
                        <img class="img-responsive img-centered" src="<?php// echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/roundicons-free.png"); ?>" alt="">
                        <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                        <p>
                            <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                        <ul class="list-inline">
                            <li>Date: July 2014</li>
                            <li>Client: Round Icons</li>
                            <li>Category: Graphic Design</li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 2>
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <br />
                    <h3>How far would you explore?</h3>
                    <Form class="form-inline" role="form">
                        <div class="form-group">
                            <label for="distance">How far?</label>
                            <input type="text" class="form-control" id="distance" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="unit">
                                <option value="K" selected>Km</option>
                                <option value="M">Mile</option>
                            </select>
                        </div>
                        <input type="hidden" id="latitude" />
                        <input type="hidden" id="longitude" />
                        <button type="button" class="btn btn-default" id="apply">Apply</button>
                        <input type="hidden" id="latitude" />
                        <input type="hidden" id="longitude" />
                        <!--input type="range" id="distance" onchange="updateMap()" /><output id="distanceVal"></output>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br />
            <input type='hidden' id='f_current_page' />
            <div class="row">
                <div class="col-md-6">
                    <div class="fa-border">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Forest</th>
                                <th>Km</th>
                                <th>Recreation</th>
                                <th>Map</th>
                            </tr>
                            </thead>
                            <tbody id="forest_list">
                            </tbody>
                        </table>
                        <div id="f_pagination"></div>
                    </div>
                </div>
                <br />
                <div class="col-md-6">
                    <div class="fa-border" id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 3>
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here>
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="<?php //echo site_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/treehouse-preview.png"); ?>" alt="">
                        <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div-->