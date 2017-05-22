#!/bin/bash
#
# This script installs all software components and configures the system
# to run the Tent Controller.

# @TODO: Check if CLI PHP getting error after installing php7.0-sqlite3 on fresh install
#    Test: 
#			pi@gtmcs:~/www/gtmcs $ php -v
#			PHP Warning:  PHP Startup: Unable to load dynamic library '/usr/lib/php/20151012/pdo_sqlite.so' - /usr/lib/php/20151012/pdo_sqlite.so: undefined symbol: php_pdo_unregister_driver in Unknown on line 0
#			PHP 7.0.16-3 (cli) (built: Feb 22 2017 10:03:06) ( NTS )
#			Copyright (c) 1997-2017 The PHP Group
#			Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
#			    with Zend OPcache v7.0.16-3, Copyright (c) 1999-2017, by Zend Technologies
#    Fix: edit '/etc/php/7.0/cli/conf.d/20-pdo_sqlite.ini'
#         comment out extension: ';extension=pdo_sqlite.so' 

# If using local cam - add to /boot/config.txt
# start_x=1
# start_x=1
# gpu_mem=144
# disable_camera_led = 1
#
# echo "bcm2835-v4l2" | sudo tee -a /etc/modules
# or 
# sudo sh -c 'echo "bcm2835-v4l2" >> /etc/modules'
# then reboot - the module actually creates /dev/video0

# motioneyeos vs motioneye
# boardctl.py
# extractl.py
# ipctl.py
# platformupdate.py
# servicectl.py
# streameyectl.py
# watchctl.py

INSTALL="/home/pi/gtmcs"
BINROOT="$INSTALL/bin/"
WEBROOT="$INSTALL/www/"

# Colors for msg outputs
Color_Off="\033[0m"       # Text Reset
Black="\033[0;30m"        # Black
Red="\033[0;31m"          # Red
Green="\033[0;32m"        # Green
Yellow="\033[0;33m"       # Yellow
Blue="\033[0;34m"         # Blue
Purple="\033[0;35m"       # Purple
Cyan="\033[0;36m"         # Cyan
White="\033[0;37m"        # White

update_preferences() {
	msg "Adding Jessie as preferred release in /etc/apt/preferences"
	echo "" >> /etc/apt/preferences
	echo "Package: *" >> /etc/apt/preferences
	echo "Pin: release n=jessie" >> /etc/apt/preferences
	echo "Pin-Priority: 600" >> /etc/apt/preferences
}

update_sources() {
	repo="deb http://mirrordirector.raspbian.org/raspbian/ stretch main contrib non-free rpi"
	if ! grep -q "^$repo" /etc/apt/sources.list /etc/apt/sources.list.d/*; then
		msg "Adding stretch repos to /etc/apt/sources.list"
		# Add the repo here
		echo "" >> /etc/apt/sources.list
		echo "# We use these to get a few updated packages not availble in Jessie" >> /etc/apt/sources.list
		echo "$repo" >> /etc/apt/sources.list
	fi

	if [ -f /etc/apt/preferences ]; then
		if ! grep -q "Pin: release n=jessie" /etc/apt/preferences; then
			update_preferences
		fi
	else
		update_preferences
	fi
}

disable_serial() {
	msg "Disabling serial console"
	systemctl stop serial-getty@ttyS0.service
	systemctl disable serial-getty@ttyS0.service
	
	if grep -q "console=serial0,115200" /boot/cmdline.txt; then
		msg "Removing serial console from /boot/cmdline.txt"
		sed -i 's/console=serial0,115200 //' /boot/cmdline.txt
	fi

	if ! grep -q "dtoverlay=pi3-miniuart-bt" /boot/config.txt; then
		msg "Swapping serial ports"
		echo "dtoverlay=pi3-miniuart-bt" >> /boot/config.txt
	fi
	
}

update_packages() {
	apt-get update 
}

upgrade_system() {
	apt-get -y upgrade
	apt-get -y install pprompt
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
	msg "Configuring PHP7"
	# Update user and group preference for FPM pool
	sed -i 's,^\(user = \).*,\1'pi',' /etc/php/7.0/fpm/pool.d/www.conf
	sed -i 's,^\(group = \).*,\1'pi',' /etc/php/7.0/fpm/pool.d/www.conf 

	msg "Installing Nginx"
	apt-get -y -t stretch install nginx
	msg "Configuring Nginx"
	# Add new Nginx configuration for our website
	cat <<EOT > /etc/nginx/sites-available/gtmcs.conf
server {
    #listen 80;
    index index.php;

    ## Begin - Server Info
    root $WEBROOT;
    server_name localhost;
    ## End - Server Info

    ## Begin - Index
    # for subfolders, simply adjust:
    # \`location /subfolder {\`
    # and the rewrite to use \`/subfolder/index.php\`
    location / {
        #try_files $uri $uri/ /index.html /index.php;
        try_files $uri $uri/ $uri.php$is_args$query_string;
    }
    ## End - Index

    ## Begin - PHP
    location ~ \.php$ {
        # Choose either a socket or TCP/IP address
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root/\$fastcgi_script_name;
    }
    ## End - PHP

    ## Begin - Security
    # deny all direct access for these folders
    location ~* /(.git|cache|bin|logs|backups|tests)/.*$ { return 403; }
    # deny running scripts inside core system folders
    location ~* /(system|vendor)/.*\.(txt|xml|md|html|yaml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny running scripts inside user folder
    location ~* /user/.*\.(txt|md|yaml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny access to specific files in the root folder
    location ~ /(LICENSE.txt|composer.lock|composer.json|nginx.conf|web.config|htaccess.txt|\.htaccess) { return 403; }
    ## End - Security
}
EOT

	if [ -f /etc/nginx/sites-enabled/default ]; then
		rm /etc/nginx/sites-enabled/default
	fi
	if [ ! -f /etc/nginx/sites-available/gtmcs.conf ]; then
		ln -s /etc/nginx/sites-available/gtmcs.conf /etc/nginx/sites-enabled/
	fi

	systemctl restart nginx
	systemctl restart php7.0-fpm

	msg "Installing Supervisor"
	apt-get -y install supervisor

	msg "Configuring Supervisor"
	#@TODO: Finish this.
}

msg() {
	echo -e "$Green$(date '+%Y-%m-%d %H:%M:%S'): $Yellow$1$Color_Off"
}

if [ "$UID" != "0" ]; then
	sudo -H "$0" "$@"
	exit $?
fi

# --- Main Installation ---

msg "Starting GT-MCS Installation"

update_sources

# This is just for dev - remove SKIPUPDATES variable for final version
if [ ! -z ${SKIPUPDATES} ]; then
	update_packages
	upgrade_system
fi

install_system_software

disable_serial

# Now we need to move over our stuff from Github
msg "Installing components"
mkdir "$INSTALL"
mkdir "$BINROOT"
cp -R bin/* "$BINROOT"
mkdir "$WEBROOT"
cp -R www/* "$WEBROOT"

msg "Fixing permissions"
chown -R pi:pi "$INSTALL"

msg "Installation is complete.  Please refer to the getting started wiki."

