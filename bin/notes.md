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

* Check if CLI PHP getting error after installing php7.0-sqlite3 on fresh insttall
  Test:
  ```
  $ php -v
  PHP Warning:  PHP Startup: Unable to load dynamic library '/usr/lib/php/20151012/pdo_sqlite.so' - /usr/lib/php/20151012/pdo_sqlite.so: undefined symbol: php_pdo_unregister_driver in Unknown on line 0
  pdo_sqlite.so: undefined symbol: php_pdo_unregister_driver in Unknown on line 0
	PHP 7.0.16-3 (cli) (built: Feb 22 2017 10:03:06) ( NTS )
	Copyright (c) 1997-2017 The PHP Group
	Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
  	  with Zend OPcache v7.0.16-3, Copyright (c) 1999-2017, by Zend Technologies
  ```
  Fix:
  	edit '/etc/php/7.0/cli/conf.d/20-pdo_sqlite.ini' and comment out extension: ';extension=pdo_sqlite.so' 


# Random
motioneyeos vs motioneye
* boardctl.py
* extractl.py
* ipctl.py
* platformupdate.py
* servicectl.py
* streameyectl.py
* watchctl.py


