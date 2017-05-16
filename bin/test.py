#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker 
from gtms_db import Base, User
from passlib.hash import bcrypt
import getpass

engine = create_engine('sqlite:///gtmcs.db')
User.metadata.bind = engine
DBSession = sessionmaker(bind=engine)
session = DBSession()

password = getpass.getpass('Enter password:')
try:
	new_user = User(name='admin', password=bcrypt.hash(password))
	session.add(new_user)
	session.commit()
	
except Exception as e:
	print("Exception: {}".format(e))
