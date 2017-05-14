<?php

$error = false;
$errormsg = "";

try {
    $sqlite = new SQLite3('../gtmcs.db');
}
catch (Exception $exception) {
    $errordb = true;
    $errormsg = $exception->getMessage();
}

if (isset($_POST['login'])) {
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['inputUser']);
    $password = $_POST['inputPassword'];

    $query = "SELECT password FROM user WHERE name='$username'";
    $res = $sqlite->query($query)->fetchArray();
    if ($res) {
        if (password_verify($password, $res["password"])) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: overview.php');
            die();
        } 

        $error = true;
        $errormsg = "<strong>Unknown username or password.</strong> Please try again.";
    }
    else {
        $error = true;
        $errormsg = "<strong>Unknown username or password.</strong> Please try again.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Please Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/css/signin.css" rel="stylesheet">
</head>

<body>

    <div class="container">
    	<?php if ($error) { ?>
    	<div class="alert alert-danger" role="alert">
    		<?php echo $error_msg; ?>
    	</div>
    	<?php } ?>


        <form method="post" action="" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputUser" class="sr-only">Username</label>
            <input type="string" id="inputUser" name="inputUser" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
        </form>

    </div> <!-- /container -->
</body>
</html>
