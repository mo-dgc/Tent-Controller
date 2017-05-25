#!/bin/bash

. $(dirname $(readlink -f $0))/funcs.sh

# These are set per OS
INSTALL="/home/pi/gtmcs"
BINROOT="$INSTALL/bin/"
WEBROOT="$INSTALL/www/"
APPUSER="pi"

apt_update_preferences() {
	if [ ! sed -n -e '/Pin: release n=jessie/,/Pin-Priority 600/!d' /etc/apt/preferences > /dev/null 2>&1 ]; then
		msg "Adding Jessie as preferred release in /etc/apt/preferences"
		echo "" >> /etc/apt/preferences
		echo "Package: *" >> /etc/apt/preferences
		echo "Pin: release n=jessie" >> /etc/apt/preferences
		echo "Pin-Priority: 600" >> /etc/apt/preferences
	else
		msg "Jessie is already pinned in /etc/apt/preferences"
	fi
}

apt_update_sources() {
	repo="deb http://mirrordirector.raspbian.org/raspbian/ stretch main contrib non-free rpi"
	if ! grep -q "^$repo" /etc/apt/sources.list /etc/apt/sources.list.d/*; then
		msg "Adding stretch repos to /etc/apt/sources.list"
		echo "" >> /etc/apt/sources.list
		echo "# We use these to get a few updated packages not availble in Jessie" >> /etc/apt/sources.list
		echo "$repo" >> /etc/apt/sources.list
	else
		msg "Stretch repos already configured in /etc/apt/sources.list"
	fi
}

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
	apt-get -y -t stretch install php7.0 php7.0-curl php7.0-gd php7.0-fpm php7.0-cli php7.0-opcache php7.0-mbstring php7.0-xml php7.0-zip php7.0-sqlite3

	msg "Installing Nginx"
	apt-get -y -t stretch install nginx

	# Supervisor needed?
	#msg "Installing Supervisor"
	#apt-get -y install supervisor
}

apt_update_sources
apt_update_packages
apt_upgrade_packages
apt_update_preferences
install_system_software

