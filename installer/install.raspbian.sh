#!/bin/bash

. $(dirname $(readlink -f $0))/funcs.sh


apt_update_preferences() {
	if [ ! -f /etc/apt/preferences ] || 
		 [ ! sed -n -e '/Pin: release n=jessie/,/Pin-Priority 600/!d' /etc/apt/preferences ]; then
		msg "Adding Jessie as preferred release in /etc/apt/preferences"
		echo "" >> /etc/apt/preferences
		echo "Package: *" >> /etc/apt/preferences
		echo "Pin: release n=jessie" >> /etc/apt/preferences
		echo "Pin-Priority: 600" >> /etc/apt/preferences
	else
		log "Jessie is already pinned in /etc/apt/preferences"
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
		log "Stretch repos already configured in /etc/apt/sources.list"
	fi
}

apt_update_packages() {
	msg "Calling apt-get update"
	apt-get update >> install.log 2>&1
}

apt_upgrade_packages() {
	msg "Calling apt-get upgrade"
	apt-get -y upgrade >> install.log 2>&1
}

apt_update_sources
apt_update_packages
apt_upgrade_packages
apt_update_preferences

