#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from passlib.hash import bcrypt

hash = bcrypt.hash("password")
print(hash)


# Verify
phphash = "$2y$10$LxDH6uPQLHtaXwI9Rt/J8OMNrbuM6.hScwkro2ky4zUQbmNZAoBam"
print(bcrypt.verify("password", phphash))
print(bcrypt.verify("notpassword", phphash))

