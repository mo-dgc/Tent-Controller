<?php
// $stream_url = "http://gtmcs.local:8765/picture/1/current/";
// $stream_url = "/static/img/tomatoes.jpg";
$stream_url = "http://pi0.local:8080/";
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

  </head>
<body>
<div class="containeri-fluid">
<ul class="nav nav-pills nav-stacked col-sm-2 no-gutters">
  <li class="active"><a href="#tab_a" data-toggle="pill"><span class="fa-stack fa-lg pull-left"><i class="fa fa-dashboard fa-stack-1x ">Pill A</a></li>
  <li><a href="#tab_b" data-toggle="pill">Pill B</a></li>
  <li><a href="#tab_c" data-toggle="pill">Pill C</a></li>
  <li><a href="#tab_d" data-toggle="pill">Pill D</a></li>
</ul>
<div class="tab-content col-sm-10">
        <div class="tab-pane active" id="tab_a">
<div class="row">
             <h4>Pane A</h4>
<p><img width="600px" class="img-responsive img-rounded" src="<?php echo $stream_url; ?>" alt="Latest picture" /></p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
</div>
        <div class="tab-pane" id="tab_b">
             <h4>Pane B</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
        <div class="tab-pane" id="tab_c">
             <h4>Pane C</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
        <div class="tab-pane" id="tab_d">
             <h4>Pane D</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas.</p>
        </div>
</div><!-- tab content -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery</script>
    <script src="/static/js/bootstrap.min.js"></script>
</body>
</html>
