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
            <img class="first-slide" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-3.jpg"); ?>" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>State Forests of Victoria</h1>
                    <p>Search for the nearest State Forests.Explore the Greenery,peace and adventures.</p>
                    <p><a class="btn btn-lg btn-primary" href="#portfolio" role="button">Explore</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-2.jpg"); ?>" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Indulge in Adventure</h1>
                    <p>Know about the different kind of Activities that can be done in state Forests.</p>
                    <p><a class="btn btn-lg btn-primary" href="#portfolio" role="button">Activities</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/Header/HeaderImage-1.jpg"); ?>" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Give us your Feedback</h1>
                    <p>Tell us your opinion about places,activities and more.</p>
                    <p><a class="btn btn-lg btn-primary" href="#contact" role="button">Feedback</a></p>
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
                <a href="Coming" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/KnowyourForest.jpg"); ?>" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Know Your Forest</h4>
                    <p class="text-muted">Victorian Forest</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="Distance" class="portfolio-link">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/location.jpg"); ?>" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Search the Location</h4>
                    <p class="text-muted">Select the Forest you want to visit.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="Coming" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-tree"></i>
                        </div>
                    </div>
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/activities.jpg"); ?>" class="img-responsive" alt="">
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
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">About</h2>
                <h3 class="section-subheading text-muted">Story of development and new beginnings</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/about/1.jpg"); ?>" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2016</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">This company was formed by 4 students of Monash University in an endavour to provide an alternative to active lifestyle options. </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/about/2.jpg"); ?>" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2016</h4>
                                <h4 class="subheading">Explore Forest is Born</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Our child-Explore forest was conceptualised and put into motion for the development.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/about/3.jpg"); ?>" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>April 2016</h4>
                                <h4 class="subheading">Phase two expansion</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Phase two expansion</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/about/4.jpg"); ?>" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>May 2016</h4>
                                <h4 class="subheading">Transition to Full service</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Transition to Full service</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
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
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/team/navjot.jpg"); ?>" class="img-responsive img-circle" alt="">
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
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/team/gus.jpg"); ?>" class="img-responsive img-circle" alt="">
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
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/team/wade.jpg"); ?>" class="img-responsive img-circle" alt="">
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
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/team/frank.jpg"); ?>" class="img-responsive img-circle" alt="">
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

<!-- Clients Aside -->
<aside class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="#">
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/logos/pwc.png"); ?>" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/logos/deltasolutions.png"); ?>" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-4">
                <a href="#">
                    <img src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/logos/monash.jpg"); ?>" class="img-responsive img-centered" alt="">
                </a>
            </div>
        </div>
    </div>
</aside>

<!-- Contact Section -->
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

<!-- Portfolio Modal 1 -->
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
                        <!-- Project Details Go Here -->
                        <h2>Explore the Forests</h2>
                        <p class="item-intro text-muted">Seelect various forests to get the information</p>
                        <img class="img-responsive img-centered" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/roundicons-free.png"); ?>" alt="">
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

<!-- Portfolio Modal 2 -->
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
                        <!--input type="range" id="distance" onchange="updateMap()" /><output id="distanceVal"></output-->
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

<!-- Portfolio Modal 3 -->
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
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/img/portfolio/treehouse-preview.png"); ?>" alt="">
                        <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/jquery.js"); ?>"></script>

<!--custom script -->
<script src="<?php echo base_url("assets/js/ajax.js"); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/bootstrap.min.js"); ?>" ></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/classie.js"); ?>"></script>
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/cbpAnimatedHeader.js"); ?>"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/jqBootstrapValidation.js"); ?>"></script>
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/contact_me.js"); ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/agency.js"); ?>"></script>

</body>

</html>