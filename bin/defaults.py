#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker 
from gtmcs_db import Base, User
from passlib.hash import bcrypt
import getpass

engine = create_engine('sqlite:///gtmcs.db')
User.metadata.bind = engine
DBSession = sessionmaker(bind=engine)
session = DBSession()


# Does admin account already exist?
admin_exists = session.query(User).filter(User.name == "admin").count() == 1
if not admin_exists:
	password = getpass.getpass('Enter password for admin:')
	verify = getpass.getpass('Retype password:')

	if not password == verify:
		print("Both passwords must be the same.")
		raise SystemExit

	passhash = bcrypt.hash(password)
	new_user = User(name="admin", password=bcrypt.hash(password))
	session.add(new_user)
	session.commit()

	print("Created admin account.")
else:
	print("Admin account already exists.  If you need to reset the password use the usermod utility.")

# Other stuff here.
