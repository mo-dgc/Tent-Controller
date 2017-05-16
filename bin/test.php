<?php
$db = new SQLite3("gtmcs.db");
$query = "SELECT password FROM user WHERE name = 'admin'";
$res = $db->query($query)->fetchArray();
//$row = $res->fetchArray();

if ($res) {
	print_r($res);
	$password = readline("Enter password: ");

	if (password_verify($password, $res["password"])) {
		echo "Good to go\n";
	} else {
		echo "Naughty hacker.\n";
	}
} else {
	echo "User not found.";
}
?>