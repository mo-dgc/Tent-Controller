<?php
global $db;

$dbfile = "../gtmcs.db";

if (isset($db)) return;

try {
	$db = new SQLite3($dbfile);
}
catch (Exception $exception) {
	die(sprintf("Can't open database: %s\n", $exception->getMessage()));
}

?>