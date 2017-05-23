<?php

$error = false;
$errormsg = "";

$username = null;
$password = null;

if ($_SERVER["REMOTE_ADDRR"] == "127.0.0.1") {
$session_start();
$session_key = session_id();
$_SESSION["username"] = "dashboard";
header("Location: overview.php");
die;
}

if (isset($_POST['login'])) {
	require_once("database.php");
	$username = preg_replace('/[^A-Za-z]/', '', $_POST["inputUser"]);
	$password = $_POST["inputPassword"];
	
    $query = $db->prepare("SELECT id,password FROM user WHERE name=:user");
    $query->bindParam(":user", $username);
    $result = $query->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $query->close();

	if (!empty($row["id"]) && password_verify($password, $row["password"])) {
        $userid = $row["id"];
        session_start();
        $session_key = session_id();
            
		$_SESSION['username'] = $username;

        $query = $db->prepare("INSERT INTO sessions (userid, key, expires) VALUES (:userid, :key, DateTime('now','localtime','+1 hour'))");
        $query->bindParam(":userid", $userid);
        $query->bindParam(":key", $session_key);
        $query->execute();
        $query->close();
            
        header('Location: overview.php');
		die;
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
    	<div class="alert alert-danger text-center" role="alert">
    		<?php echo $errormsg; ?>
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
