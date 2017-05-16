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
    
    <link href="./static/css/bootstrap-toggle.min.css" rel="stylesheet">
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

        <form method="post" class="form-horizontal">

<fieldset>
<legend>Dashboard</legend>

<!-- Select Basic -->
<div class="form-group">
<!--
<span tabindex="0" class="glyphicon glyphicon-info-sign" role="button" data-toggle="popover" data-trigger="focus" title="Display for overview" data-content="What to display on the dashboard page. Livestream and Snapshot requires valid URLs in the Stream and Snapshot URL fields below."></span>
-->
<span tabindex="0" class="glyphicon glyphicon-info-sign" role="button" data-toggle="popover" data-trigger="focus" data-content="What to display on the dashboard page. Livestream and Snapshot require a valid URL to be populated in the Stream and Snapshot URLs below."></span>

<label class="col-md-4 control-label" for="selectOverview">Display for overview</label>
<div class="col-md-4">
<select id="selectOverview" name="selectOverview" class="form-control input-md">
<option>Data Only</option>
<option id="selOverviewLivestream" disabled>Display Livestream</option>
<option id="selOverviewSnapshot" disabled>Display Snapshot</option>
</select>
</div>
</div>

<!-- Text input-->
<div class="form-group">
<span tabindex="0" class="glyphicon glyphicon-info-sign" role="button" data-toggle="popover" data-trigger="focus"  data-content="URL for Livestream"></span>
<label class="col-md-4 control-label" for="streamurl">Stream URL</label>  
<div class="col-md-4">
<input id="streamurl" name="streamurl" type="text" class="form-control input-md">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="snapshoturl">Snapshot URL</label>  
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
<!--input type="checkbox" checked data-toggle="toggle" data-on="On Text" data-off="Off Text"....-->
<input id="timelapse" name="timelapse" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
</div>
</div>


<!-- Select Basic -->
<div class="form-group">
<label class="col-md-4 control-label" for="selectTimelapseSource">Generate timelapse from</label>
<div class="col-md-4">
<select id="selectTimelapseSource" disabled name="selectTimelapseSource" class="form-control input-md">
<option>Livestream</option>
<option>Snapshots</option>
</select>
</div>
</div>

<!-- Text input-->
<div id="tl_interval" class="form-group">
<label class="col-md-4 control-label" for="timelapseInterval">Snapshot Interval (minutes)</label>  
<div class="col-md-4">
<input id="timelapseInterval" disabled name="timelapseInterval" type="number" placeholder="60" class="form-control input-md">
</div>
</div>


</fieldset>

<fieldset>
<legend>Radios</legend>

<!-- take a look at http://itsolutionstuff.com/post/simple-add-remove-input-fields-dynamically-using-jquery-with-bootstrapexample.html -->
<!-- Text input -->
<div class="form-group">
<button disabled class="btn btn-primary"">Add Radio Device</button>
<label class="col-md-4 control-label" for="radio">Radio device</label>
<div class="col-md-4">
<input id="radio" name="radio" type="text" class="form-control input-md">
</div>
</div>
</fieldset>

<fieldset>
<legend>SMTP Configuration</legend>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_server">SMTP Server</label>  
<div class="col-md-4">
<input id="smtp_server" name="smtp_server" type="text" class="form-control input-md">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_port">SMTP Port</label>  
<div class="col-md-4">
<input id="smtp_port" name="smtp_port" type="text" class="form-control input-md">
</div>
</div>

<!-- Checkbox -->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_usetls">Use TLS?</label>
<div class="col-md-4"> 
<input type="checkbox" name="smpt_usetls" id="smtp_usetls" checked="checked">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_user">Username</label>  
<div class="col-md-4">
<input id="smtp_user" name="smtp_user" type="text" class="form-control input-md">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_pass">Password</label>  
<div class="col-md-4">
<input id="smtp_pass" name="smtp_pass" type="password" class="form-control input-md">
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="smtp_recipients">Email recipients (comma separated)</label>  
<div class="col-md-4">
<input id="smtp_recipients" name="smtp_recipients" type="text" class="form-control input-md">
</div>
</div>

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
    <script src="./static/js/bootstrap-toggle.min.js"></script>
<script>
function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

// Toggle Timelapse fields
$(function() {
$('#timelapse').change(function() {
$('#selectTimelapseSource').prop('disabled', function(i,v){return !v;});
$('#timelapseInterval').prop('disabled', function(i,v){return !v;});;
})
})

// Validate Stream URL
$('#streamurl').keyup(function(){
 if (isUrlValid($('#streamurl').val())) {
  $('#selOverviewLivestream').prop('disabled', false);
 }
});

// Validate Snapshot URL
$('#snapshoturl').keyup(function(){
 if (isUrlValid($('#snapshoturl').val())) {
  $('#selOverviewSnapshot').prop('disabled', false);
 }
});

// Activate all popovers
$(function () {
  $('[data-toggle="popover"]').popover()
})

// Make popovers dismiss on click
$('.popover-dismiss').popover({
  trigger: 'focus'
})

</script>
  </body>
</html>
