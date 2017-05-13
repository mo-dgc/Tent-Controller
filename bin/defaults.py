#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker 
from create_db import Base, User
from passlib.hash import bcrypt
import getpass

password = getpass.getpass('Enter password for admin:')
verify = getpass.getpass('Retype password:')
if not password == verify:
	print("Both passwords must be the same.")
	raise SystemExit

passhash = bcrypt.hash(password)

engine = create_engine('sqlite:///gtmcs.db')
User.metadata.bind = engine
DBSession = sessionmaker(bind=engine)
session = DBSession()
new_user = User(name='admin', password=passhash)
session.add(new_user)
session.commit()
