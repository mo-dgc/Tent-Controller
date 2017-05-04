#!/usr/bin/env php
<?php

if ( $argc != 3) {
	print "\nUsage: " . $argv[0] . " username password\n\n";
	die;
}

$username = strtolower(preg_replace('/[^A-Za-z]/', '', $argv[1]));
$password = $argv[2];

$userXML = new SimpleXMLElement("<user></user>");
$userXML->addChild('password', password_hash($password, PASSWORD_BCRYPT));
$userXML->asXML($username . '.xml');

print "\nCreated '$username.xml'\n\n";

?>