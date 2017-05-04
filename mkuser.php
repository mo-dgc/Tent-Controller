#!/usr/bin/env php
<?php

if ( $argc != 2) {
	print "\nUsage: " . $argv[0] . " password_to_hash\n\n";
	die;
}

$password = $argv[1];
print "\n" . password_hash($password, PASSWORD_BCRYPT) . "  \n\n";

?>