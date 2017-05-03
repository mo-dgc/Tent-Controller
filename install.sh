#!/bin/bash
#
# This script installs all software components and configures the system
# to run the Tent Controller.

INSTALL="/home/pi/gtmcs/"

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

update_packages() {
	apt-get update 
}

upgrade_system() {
	apt-get -y upgrade
	apt-get -y install pprompt
}

install_system_software() {
	msg "Installing Python"
	apt-get -y install python-dev python-pip python-setuptools
	apt-get -y install python3 python3-dev python3-pip python3-setuptools

	msg "Installing PHP7"
	apt-get -y -t stretch install php7.0 php7.0-curl php7.0-gd php7.0-fpm php7.0-cli php7.0-opcache php7.0-mbstring php7.0-xml php7.0-zip
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
    index index.html index.php;

    ## Begin - Server Info
    root /home/pi/www/gtmcs;
    server_name localhost;
    ## End - Server Info

    ## Begin - Index
    # for subfolders, simply adjust:
    # \`location /subfolder {\`
    # and the rewrite to use \`/subfolder/index.php\`
    location / {
        try_files \$uri \$uri/ /index.html /index.php;
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
#update_packages
#upgrade_system
install_system_software

# Now we need to move over our stuff from Github

msg "Installation is complete"

