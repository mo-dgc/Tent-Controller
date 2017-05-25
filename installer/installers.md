# OS Specific Installer scripts

To add additional OS support, use the following guidelines:

Should be named ```install.os.DISTRO.sh```.

Should do any OS specific set up tasks and install the required software packages:

* Git
* Python 3 w/Pip
* Avahi
* Sqlite3
* nginx
* php7-fpm

Also needs to set the following variables:
* ```INSTALL``` - Base path to install ```bin/``` and ```www/```
* ```BINROOT``` - BIN path - default to ```$INSTALL/bin/```
* ```WEBROOT``` - WWW path - default to ```$INSTALL/www/```
* ```APPUSER``` - User to set as owner for ```bin``` and ```www```, PHP-fmp will also be set to run as this user


# Hardware Specific Installer scirpts

To add additional hardware support use the following guidelines:

Should be named ```install.hw.PLATFOM.sh```.

Should do any hardware specific set up tasks, such as Raspberry Pi, C.H.I.P, etc.

