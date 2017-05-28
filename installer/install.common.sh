#!/bin/bash

. $INSTALLER_DIR/funcs.sh

configure_php7() {
	msg "Configuring PHP7"
	# Update user and group preference for FPM pool
	sed -i 's,^\(user = \).*,\1'$APPUSER',' /etc/php/7.0/fpm/pool.d/www.conf
	sed -i 's,^\(group = \).*,\1'$APPUSER',' /etc/php/7.0/fpm/pool.d/www.conf 

}

configure_nginx() {
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
        try_files \$uri \$uri/ \$uri.php\$is_args\$query_string;
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
		msg "Removing default site"
		rm /etc/nginx/sites-enabled/default
	fi

	if [ ! -f /etc/nginx/sites-enabled/gtmcs.conf ]; then
		msg "Enabling gtmcs site"
		ln -s /etc/nginx/sites-available/gtmcs.conf /etc/nginx/sites-enabled/
	fi

	systemctl restart nginx
	systemctl restart php7.0-fpm
}
