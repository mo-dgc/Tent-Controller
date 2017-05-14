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