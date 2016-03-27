<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">

    <title>XploreForest</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url("assets/css/ie10-viewport-bug-workaround.css"); ?> rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url("assets/js/ie-emulation-modes-warning.js"); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("assets/css/carousel.css"); ?>" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="Home">XploreForest</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="Home">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Visit <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Know your Forest</a></li>
                    <li><a href="Locations">Find Location</a></li>
                    <li><a href="#">Choose Activities</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Other Information</li>
                    <li><a href="#">Weather Forecast</a></li>
                    <li><a href="#">Bushfire Information</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="img-responsive carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="<?php echo base_url("assets/img/8584215787_13aa9aced5_o.jpg"); ?>" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>State Forests of Victoria</h1>
              <p>Search for the nearest State Forests.Explore the Greenery,peace and adventures.</p>
              <p><a class="btn btn-lg btn-primary" href="Locations" role="button">Explore</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="<?php echo base_url("assets/img/Stanley.jpg"); ?>" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Indulge in Adventure</h1>
              <p>Know about the different kind of Activities that can be done in state Forests.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Activities</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="<?php echo base_url("assets/img/15975523713_4077d07beb_o.jpg"); ?>" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Give us your Feedback</h1>
              <p>Tell us your opinion about places,activities and more.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Feedback</a></p>
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


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo base_url("assets/img/location.jpg"); ?>" alt="Generic placeholder image" width="150" height="150">
          <h2>SearchMe</h2>
          <p>This feature will let you explore the forests around your location and give you the important information about the forests,tips and locations.</p>
          <p><a class="btn btn-default" href="Locations" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo base_url("assets/img/activities.jpg"); ?>" alt="Generic placeholder image" width="150" height="150">
          <h2>Activities</h2>
          <p>Explore the forests based on the activities you want to do.This will guide you to do favourite activities on perfect spot.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="<?php echo base_url("assets/img/weather.jpg"); ?>" alt="Generic placeholder image" width="150" height="150">
          <h2>Travel Info</h2>
          <p>Get to know the weather forecasts,weather emergency or any related information about the forests.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Know Your Forest. <span class="text-muted">Explore the wilderness.</span></h2>
          <p class="lead">Unexplored lands.Beautiful Trees.Variety of Animals.Take a plunge to connect with nature.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="<?php echo base_url("assets/img/knowyourforest.jpg"); ?>" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Feeling Adventurous? <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Find the suitable activities and spot to do it.Make memories of lifetime.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="<?php echo base_url("assets/img/camping.jpg"); ?>" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Give your Feedback. <span class="text-muted">Let us know.</span></h2>
          <p class="lead">Your feedback will help us improve the application.It is important to us.We want to know your opinion.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="<?php echo base_url("assets/img/feedback.jpg"); ?>" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2015 Delta Solutions, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url("assets/js/vendor/jquery.min.js"); ?>"><\/script>')</script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url("assets/js/vendor/holder.min.js"); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url("assets/js/ie10-viewport-bug-workaround.js"); ?>"></script>
  </body>
</html>
