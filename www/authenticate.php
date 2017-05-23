<?php
// authenticate.php

session_start();
$session_key = session_id();

require_once("database.php");

// workaround for kiosk
if (!$_SERVER["REMOTE_ADDR"] == "127.0.0.1") {

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

}
?>
