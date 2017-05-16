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

    <title>System</title>

    <!-- Bootstrap core CSS -->
    <link href="./static/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="./static/css/navbar-fixed-top.css" rel="stylesheet">

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
            <li><a href="overview.php">Overview</a></li>
            <li><a href="timers.php">Timers</a></li>
            <li><a href="graphs.php">Graphs</a></li>
            <li><a href="setpoints.php">Set Points</a></li>
            <li><a href="alarms.php">Alarms</a></li>
            <li class="active"><a href="#">System</a></li>
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
      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
        <h1>System Options</h1>
        <form class="form-horizontal">
		<fieldset>
<legend>Overview Screen</legend>
<!-- Select Basic -->
<div class="form-group">
<label class="col-md-4 control-label" for="selectOverview">Display for overview</label>
<div class="col-md-4">
<select id="selectOverview" name="selectOverview" class="form-control input-md">
<option>Data Only</option>
<option>Display Livestream</option>
<option>Display Snapshot</option>
</select>
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="streamurl">Stream URL</label>  
<div class="col-md-4">
<input id="streamurl" name="streamurl" type="text" class="form-control input-md">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="snapshoturl">Stream URL</label>  
<div class="col-md-4">
<input id="snapshoturl" name="snapshoturl" type="text" class="form-control input-md">
</div>
</div>

</fieldset>

<fieldset>
<legend>Timelapse</legend>

<!-- Multiple Radios (inline) -->
<div class="form-group">
<label class="col-md-4 control-label" for="timelapse">Create timelapse video?</label>
<div class="col-md-4"> 
<label class="radio-inline" for="timelapse-no"><input type="radio" name="timelapse" id="timelapse-no" value="No" checked="checked">No</label> 
<label class="radio-inline" for="timelapse-yes"><input type="radio" name="timelapse" id="timelapse-yes" value="Yes">Yes</label>
</div>
</div>


<!-- Select Basic -->
<div class="form-group">
<label class="col-md-4 control-label" for="selectTimelapseSource">Generate timelapse from</label>
<div class="col-md-4">
<select id="selectTimelapseSource" name="selectTimelapseSource" class="form-control input-md">
<option>Livestream</option>
<option>Snapshots</option>
</select>
</div>
</div>

</fieldset>

<fieldset>
<legend>Dunno</legend>
</fieldset>

<!-- Button -->
<div class="form-group">
<label class="col-md-4 control-label" for="submit"></label>
<div class="col-md-4">
<button id="submit" name="submit" class="btn btn-primary">Update</button>
</div>
</div>

        </form>
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
