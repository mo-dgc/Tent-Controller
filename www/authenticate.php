<?php
// authenticate.php

$error = false;
$errormsg = "";

session_start();
$session_key = session_id();

require_once("database.php");

$query = $db->prepare("SELECT id FROM sessions WHERE key=:key AND expires > DateTime('now','localtime')");
$query->bindParam(":key", $session_key );
$result = $query->execute();
$session_id = $result->fetchArray(SQLITE3_NUM)[0];
$query->close();

if (empty($session_id)) {
	header('Location: index.php');
	die;
}

$query = $db->prepare("UPDATE sessions SET expires = DateTime('now', 'localtime', '+1 hour') WHERE id=:id");
$query->bindParam(":id", $session_id);
$query->execute();
$query->close();

?>