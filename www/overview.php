<?php
require_once("authenticate.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>Overview</title>

    <!-- Bootstrap core CSS -->
    <link href="./static/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="./static/css/navbar-fixed-top.css" rel="stylesheet">

<style>
.placeholder img {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    text-align: center;
}
</style>
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse bg-inverse">
      <div class="container">
        <!--
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">GT:MCS</a>
        </div>
        -->
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="timers.php">Timers</a></li>
            <li><a href="graphs.php">Graphs</a></li>
            <li><a href="setpoints.php">Set Points</a></li>
            <li><a href="alarms.php">Alarms</a></li>
            <li><a href="system.php">System</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Profile</li>
                <li><a href="#">Change password</a></li>
                <li role="separator" class="divider"></li>
                <!--
                <li class="dropdown-header">Nav header</li>
                -->
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <p class="text-center">
                    <!--<img class="img-responsive img-rounded" src="static/img/tomatoes.jpg" alt="Latest snap from camera" />-->
                    <img class="img-responsive img-rounded" src="http://gtmcs.local:8765/picture/1/current/" alt="Latest picture" />
                    <small>Tent Cam Name</small>
                </p>
            </div>
            <div class="col-md-3">
                <div class="row text-center">
                    <img
                         src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs="
                         width="150" height="150" class="img-responsive img-circle center-block" alt="Generic placeholder thumbnail">
                        <h4>Temp</h4>
                </div>
                <div class="row text-center">
                    <img
                        src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs="
                        width="150" height="150" class="img-responsive img-circle center-block"
                        alt="Genric placeholder thumbnail">
                    <h4>Humidity</h4>
                </div>
                <div class="row text-center">
                    <img
                        src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs="
                        width="150" height="150" class="img-responsive img-circle center-block"
                        alt="generic placeholder thumbnail">
                    <h4>VPD</h4>
                </div>
            </div>
        </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery</script>
    <script src="./static/js/bootstrap.min.js"></script>
  </body>
</html>
