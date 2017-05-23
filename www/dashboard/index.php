<?php
// $stream_url = "http://gtmcs.local:8765/picture/1/current/";
$stream_url = "/static/img/tomatoes.jpg";
//$stream_url = "http://pi0.local:8080/";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
<link href="/static/css/font-awesome.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
body {
  background-color: #222;
  color: white;
overflow-y:hidden;
}
legend {
color: white;
}
</style>
  </head>
<body>
<div class="container-fluid">
<div class="row">
<ul class="nav nav-pills nav-stacked col-sm-2">
  <li class="active text-center"><a href="#tab_dashboard" data-toggle="pill">
<i class="fa fa-dashboard fa-3x fa-fw"></i>
 </a></li>
  <li class="text-center"><a href="#tab_camera" data-toggle="pill">
<i class="fa fa-camera fa-3x fa-fw"></i>
 </a></li>
  <li class="text-center"><a href="#tab_schedules" data-toggle="pill">
<i class="fa fa-calendar fa-3x fa-fw"></i>
 </a></li>
  <li class="text-center"><a href="#tab_relays" data-toggle="pill">
<i class="fa fa-plug fa-3x fa-fw"></i>
 </a></li>
<li class="text-center"><a href="#"  data-toggle="pill" onClick="window.location.reload()">
<i class="fa fa-refresh fa-3x fa-fw"></i>
</a></li>
</ul>
<div class="tab-content col-sm-10 no-gutters">
        <div class="tab-pane active" id="tab_dashboard">
         <h4>Dashboard</h4>
<p>Health guages will go on this page</p>
        </div>
 
<div class="tab-pane align-items-center no-gutters" id="tab_camera">
<img class="img-responsive img-rounded" src="<?php echo $stream_url; ?>" alt="Image stream" />
        </div>

<div class="tab-pane" id="tab_schedules">
             <h4>Pane C</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
</div>


<div class="tab-pane" id="tab_relays">

<form method="post" class="form-horizontal">

<fieldset>
<legend>Relay Control</legend>

<div class="form-group">
 <label class="col-sm-5 control-label text-right" for="relay1">Relay 1 Label</label>
 <div class="col-sm-5">
  <input id="relay1" name="relay1" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
 </div>
</div>
</fieldset>

<fieldset>
<div class="form-group">
 <label class="col-sm-5 control-label text-right" for="relay2">Relay 2 Label</label>
 <div class="col-sm-5">
  <input id="relay2" name="relay2" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
 </div>
</div>
</fieldset>

<fieldset>
<div class="form-group">
 <label class="col-sm-5 control-label text-right" for="relay3">Relay 3 Label</label>
 <div class="col-sm-5">
  <input id="relay3" name="relay3" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
 </div>
</div>
</fieldset>
<fieldset>
<div class="form-group">
 <label class="col-sm-5 control-label text-right" for="relay4">Relay 4 Label</label>
 <div class="col-sm-5">
  <input id="relay4" name="relay4" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
 </div>
</div>
</fieldset>
</form>
</div><!-- tab content -->
</div><!-- row -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery</script>
    <script src="/static/js/bootstrap.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
