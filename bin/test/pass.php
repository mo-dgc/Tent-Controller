<?php
echo password_hash("password", PASSWORD_DEFAULT)."\n";

$phash='$2b$12$NvY4TV/ynNxrcgCaGbI3veyMgJ/ddKbSXp2IaV/HnhYj2x3FmVzlO';

if (password_verify("password", $phash)) {
	echo "True";
} else {
	echo "False";
}

if (password_verify("notthepassword", $phash)) {
	echo "True";
} else {
	echo "False";
}

?>