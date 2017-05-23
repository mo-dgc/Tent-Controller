# Kiosk Install Notes

## TODO
* Add flip the display to install.sh
* Restrict /dashboard to just 127.0.0.1 via Nginx
* Add some built in authentication with startup script an internal account
  * Have defaults generate kiosk user with random password

## Installing

Flip the display
```
echo "lcd_rotate=2" | sudo tee -a /boot/config.txt
```

Install required software (This takes a while to complete - might actually look at doing full raspbian instead of lite)
```
sudo apt-get install -y midori x11-xserver-utils matchbox unclutter xinit
```

Then create ```~/kiosk.sh```

```
#!/bin/bash

# Prevent screen blanking and screensaver (optional)
xset -dpms
xset s off
xset s noblank

unclutter &
matchbox-window-manager &
midori -e Fullscreen -a http://127.0.0.1/dashboard.php
```

Edit ```/etc/rc.local``` and add the following above the exit 0.

```
sudo xinit /home/pi/kiosk/sh -- -nocursor &
```

Set up auto login to console - here's some manual links to script this later
https://www.opendisplaycase.com/tutorials-learn/raspberry-pi-startup-scripts.html


## Chromium

```
sudo apt-get install chromium-browser
```

