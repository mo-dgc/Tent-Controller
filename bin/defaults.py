#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker 
from gtmcs_db import Base, User, System, Sessions
from passlib.hash import bcrypt
import getpass

engine = create_engine('sqlite:///gtmcs.db')
DBSession = sessionmaker(bind=engine)
session = DBSession()

User.metadata.bind = engine
System.metadata.bind = engine
Sessions.metadata.bind = engine


"""
Handle Administrator Account
"""
if session.query(User).count() == 0:
	username = input("Enter username for administrator account: ")
	password = getpass.getpass("Enter password for {}: ".format(username))
	verify = getpass.getpass('Retype password:')

	if not password == verify:
		print("Both passwords must be the same.")
		raise SystemExit

	passhash = bcrypt.hash(password)
	new_user = User(name=username, password=bcrypt.hash(password))
	session.add(new_user)
	session.commit()

	print("Created {} account.".format(username))


"""
Handle System Options
"""

# Display live stream on overview page?
if session.query(System).filter(System.name == "livestream").count() == 0:
	session.add(System(name="livestream", value="False"))
	session.commit()

# Live Stream URI
if session.query(System).filter(System.name == "streamurl").count() == 0:
	session.add(System(name="streamurl", value=""))
	session.commit()

# Display snapshot on overview page?
if session.query(System).filter(System.name == "snapshot").count() == 0:
	session.add(System(name="snapshot", value=""))
	session.commit()

# Snapshot URL
if session.query(System).filter(System.name == "snapshoturl").count() == 0:
	session.add(System(name="snapshoturl", value=""))
	session.commit()

# Generate timelapse video?
if session.query(System).filter(System.name == "timelapse").count() == 0:
	session.add(System(name="timelapse", value="False"))
	session.commit()

# Generate timelapse from live stream (0) or snapshot(1)?
if session.query(System).filter(System.name == "timelapsefrom").count() == 0:
	session.add(System(name="timelapsefrom", value="0"))
	session.commit()


