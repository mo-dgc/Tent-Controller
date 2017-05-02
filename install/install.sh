#!/bin/bash
#
# This script installs all software components and configures the system
# to run the Tent Controller.

INSTALL="/home/rpi/gtmcs/"
logFile="$0.log"

# --- Simple Log Messages ---
msg() {
  echo -e "$(date): $1"
}

# --- main installation program ---

# Check to make sure we are root first
if [ "$UID" != "0" ]; then
	sudo -H "$0" "$@"
	exit $?
fi

# --- Make sure system is up to date
msg "Updating packages"
apt-get update
msg "Upgrading system"
apt-get -y upgrade

msg "Installing required packages"
apt-get -y install git-core \
									 python-dev python-pip python-setuptools \
									 avahi-daemon \
									 nginx supervisor

msg "Installing virtualenvwrapper"
pip install virtualenv virtualenvwrapper
echo "source /usr/local/bin/virtualenvwrapper.sh" >> /etc/bash.bashrc
source "/usr/local/bin/virtualenvwrapper.sh"

msg "Configuring virtual env"
if [ ! -d "$INSTALL" ]; then
	mkdir "$INSTALL"
fi
mkvirtualenv -a "$INSTALL" gtmcs
pip install django docutils south gunicorn
deactivate

# Now we need to move over the files from the repo
# @TODO: Finish this once we have files. :D

msg "Configuring Supervisor"
cat <<EOT >> /etc/supervisor/conf.d

[program:gunicorn]
command = /home/pi/.virtualenvs/gtmcs/bin/python /home/pi/gtmcs/manage.py run_gunicorn -w 4
directory = /home/pi/gtmcs
user = pi
autostart = true
autorestart = true
stdout_logfile = /var/log/supervisor/gunicorn.log
stderr_logfile = /var/log/supervisor/gunicorn_err.log
EOT

# Restart service
service supervisor restart

# Configure NGinx
msg "Configuring Nginx"
sudo rm -f /etc/nginx/sites-enabled/default
cat <<EOT >> /etc/nginx/sites-available/gtmcs
# upstream server for gunicorn
upstream gunicorn {
  server localhost:8000;
}

# nginx server for the host
server {
  listen 80;
  server_name gtmcs.local;

  root /home/pi/gtmcs;

  access_log /var/log/nginx/gtmcs_access.log;
  error_log /var/log/nginx/gtmcs_error.log;

  # try to serve a static file and if it doesn't exist, pass to gunicorn
  try_files $uri @gunicorn;

  # rules for gunicorn
  location @gunicorn {
    proxy_pass http://gunicorn;
    proxy_redirect off;
    proxy_read_timeout 5m;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Fowarded-For $proxy_add_x_forwarded_for;
  }
} 
EOT
ln -s /etc/nginx/sites-available/gtmcs /etc/nginx/sites-enabled/gtmcs
service nginx restart

echo -e "\nYou should reboot now.\nType: sudo reboot\n\n"
