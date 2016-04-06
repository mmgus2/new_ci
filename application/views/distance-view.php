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

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/jquery.js"); ?>"></script>

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
    <link href="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/carousel.css"); ?>" rel="stylesheet">
    <!--for google map-->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <!--end google map-->


</head>

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
                <li>
                    <a class="page-scroll" href="Home#portfolio">Explore</a>
                </li>
                <li>
                    <a class="page-scroll" href="Home#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="Home#team">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="Home#contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <h3>How far would you explore?</h3>
                <Form class="form-inline" role="form">
                    <div class="form-group">
                        <!--label for="distance">How far?</label-->
                        <input type="text" class="form-control" id="distance" />
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="unit">
                            <option value="K" selected>Km</option>
                            <option value="M" disabled>Mile</option>
                        </select>
                    </div>
                    <input type="hidden" id="latitude" />
                    <input type="hidden" id="longitude" />
                    <button type="button" class="btn btn-default" id="apply">Apply</button>
                    <input type="hidden" id="latitude" />
                    <input type="hidden" id="longitude" />
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br />
        <input type='hidden' id='f_current_page' />
        <input type='hidden' id='s_current_page' />
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
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
                <div class="fa-border" id="site_div" hidden="true">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Site</th>
                            <th>Site name</th>
                        </tr>
                        </thead>
                        <tbody id="site_list">
                        </tbody>
                    </table>
                    <div id="s_pagination"></div>
                </div>

            </div>
            <br />
            <div class="col-md-5">
                <div class="fa-border" id="map" style="width: 100%; height: 400px;"></div>
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

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets/theme/startbootstrap-agency-1.0.6/js/bootstrap.min.js"); ?>" ></script>

<!--custom script -->
<script src="<?php echo base_url("assets/js/ajax.js"); ?>"></script>

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
