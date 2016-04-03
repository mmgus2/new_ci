<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/3/2016
 * Time: 3:37 PM
 */?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>XploreForest</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/css/agency.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--for google map-->
    <script src="http://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <!--end maplace.js-->
    <link href="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/carousel.css"); ?>" rel="stylesheet">

</head>

<style>
    #mapPlaceholder {
        height: 400px;
        width: 700px;
</style>

<body id="page-top" class="index">


<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="Home">XploreForest</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <!--
                <li>
                    <a class="page-scroll" href="#services">Search</a>
                </li>
                -->
                <li>
                    <a class="page-scroll" href="#portfolio">Explore</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#team">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<section id="portfolio">
    <div class="container modal-content">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                <br />
                <h4>Search Location by Distance</h4>
                <form class="form-inline" role="form">
                    <div class="form-group">
                        <label for="distance">Max Distance</label>
                        <input type="text" class="form-control" id="distance" />
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="unit">
                            <option value="K" selected>Kilometers</option>
                            <option value="M">Miles</option>
                        </select>
                    </div>
                    <input type="hidden" id="latitude" />
                    <input type="hidden" id="longitude" />
                    <button type="button" class="btn btn-default" id="apply">Apply</button>
                </form>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-4 col-lg-offset-1">
                <ul id="controls" style="height: 400px; overflow: scroll;"></ul>
            </div>
            <div class="col-lg-6">
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <br /><br />
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Delta Solutions 2016</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

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
