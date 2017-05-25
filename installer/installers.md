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

# Hardware Specific Installer scirpts

To add additional hardware support use the following guidelines:

Should be named ```install.hw.PLATFOM.sh```.

Should do any hardware specific set up tasks, such as Raspberry Pi, C.H.I.P, etc.

