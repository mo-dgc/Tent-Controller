# Notes

Authenticating password from Python:

```python
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker 
from create_db import Base, User
from passlib.hash import bcrypt
import getpass

engine = create_engine('sqlite:///gtmcs.db')
User.metadata.bind = engine
DBSession = sessionmaker(bind=engine)
session = DBSession()
person = session.query(User).filter(User.name == "admin").one()
password = getpass.getpass('Enter password:')

if bcrypt.verify(password, person.password):
	print("Good to go")
else:
	print("Naughty hacker")
```

Authenticating from PHP:
```php
<?php
$db = new SQLite3("gtmcs.db");
$result = $db->query("SELECT * FROM User WHERE name = 'admin'");
$row = $result->fetchArray();

$password = readline("Enter password: ");

if (password_verify($password, $row["password"])) {
	echo "Good to go\n";
} else {
	echo "Naughty hacker.\n";
}
?>
```

# For users that want to use Pi instead of Arduino:

## Relays:
* Pi controlled 5v relay: https://www.raspberrypi.org/forums/viewtopic.php?t=36225
* https://docs.google.com/file/d/0B5-HND9HJkXWSTQtYlFTZ3VyODA/edit

## Camera

If using local cam - add to /boot/config.txt
```
start_x=1
gpu_mem=144
disable_camera_led=1
```
Then:
```
echo "bcm2835-v4l2" | sudo tee -a /etc/modules
-or-
sudo sh -c 'echo "bcm2835-v4l2" >> /etc/modules'
```
Then reboot


# @TODO
* Move Streams to DB
  * stream name
  * stream url
  * stream authentication - 0=none,1=basic
  * stream auth user
  * stream auth pass
* Check install on new system again - last time had a few issues
* Check on doing install via PiBakery instead or just do our distro
* Add option to rotate through all feeds/snapshots

# @TODO - Kiosk
* Options for guages?  Default to just text only with thresholds?
* Add option for video/pic feeds on kiosk mode (for the security minded)
* Come up with some auth token for kiosk mode to display offbox
* Change kiosk to use chromium to get drag scrolling
* Add option to rotate through all feeds/snapshots

# @TODO - Sub Projects
* Pi Zero W with Raspbian and setup streameye


# Random
motioneyeos vs motioneye
* boardctl.py
* extractl.py
* ipctl.py
* platformupdate.py
* servicectl.py
* streameyectl.py
* watchctl.py


