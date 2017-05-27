#!/bin/bash

. $INSTALLER_DIR/funcs.sh

# These are set per OS
APPUSER=`logname`
INSTALL="/home/$APPUSER/gtmcs"
BINROOT="$INSTALL/bin/"
WEBROOT="$INSTALL/www/"



apt_update_packages() {
	msg "Calling apt-get update"
	apt-get update
}

apt_upgrade_packages() {
	msg "Calling apt-get upgrade"
	apt-get -y upgrade
}

install_system_software() {
	msg "Installing Avahi"
	apt-get -y install avahi-daemon

	msg "Installing Sqlite3"
	apt-get -y install sqlite3

	msg "Installing Python"
	apt-get -y install python-dev python-pip python-setuptools
	apt-get -y install python3 python3-dev python3-pip python3-setuptools python3-bcrypt python3-sqlalchemy python3-passlib

	msg "Installing PHP7"
	apt-get -y install php7.0 php7.0-curl php7.0-gd php7.0-fpm php7.0-cli php7.0-opcache php7.0-mbstring php7.0-xml php7.0-zip php7.0-sqlite3

	msg "Installing Nginx"
	apt-get -y install nginx

	# Supervisor needed?
	#msg "Installing Supervisor"
	#apt-get -y install supervisor
}

install_components() {
	msg "Installing components"
	mkdir "$INSTALL"
	mkdir "$BINROOT"
	#rsync --chown="$APPUSER":"$APPUSER" -r bin/* "$BINROOT"
	cp -R bin/* "$BINROOT"

	mkdir "$WEBROOT"
	cp -R www/* "$WEBROOT"

	msg "Fixing permissions"
	chown -R "$APPUSER":"$APPUSER" "$INSTALL"
}

apt_upgrade_packages
apt_update_preferences
install_system_software

