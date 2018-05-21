#!/usr/bin/python2.7
#coding: utf-8
"""Receive a filename and return a json object

    The file must be a modern (xlsx) Excel spreadsheet.

    The script parses the first sheet and returns the
    data as a JSON-serialized list of dicts.
"""
import json
import sys
from common import xl_read_as_dict
reload(sys)
sys.setdefaultencoding('utf-8')
MEM = []
FILE = sys.argv[1]

DAT = xl_read_as_dict(FILE)

# How to translate the headers in the Excel sheet.
# This is likely to change ....

# NB! Match this against $COLUMNS in pws-booking.
# _status_ amnd _fullname_ are special cases!
MAT = {
#    'address1': 'Adresse',
    'email': 'E-post',
    'firstname': 'Fornavn',
    'lastname': 'Etternavn',
    'phonemobile': 'Tlf. mobil',
#    'postaladdress': 'Postadresse',
#    'postalcode': 'Postnr',
    'userid': 'Tlf. mobil',
}

for row in DAT:
    """Map nif-attributes to PWS booking attributes
    
    For each user atrributes are mapped, somewhat manually.

    Ref. mysql@opk.no:/opk/opk_booking_user_import
    """

    # Login id is phonemobile, so if mobile isn't set then drop user.
    # This is the harsh reality. All valid user can go to 
    # https://mi.nif.no/MyProfile
    # and add their mobile number!
    if row['Tlf. mobil'] is None:
        continue

    # Define individual user.
    user = {}

    # Generate fullname
    user['fullname'] = u"{} {}".format(row.get('Fornavn'), row.get('Etternavn'))

    # Read attributes we are likely to need.
    for key, value in MAT.items():
        user[key] = row.get(value, "N/A")

    # Append user to list of users
    MEM.append(user)

# Return JSON-serialized list of dict to be consumed by
# wordpress plugin. Encoding utf-8 is important here. 
# NEVER NEVER NEVER EVER use latin1 or other encodings!!!!
# No win1251, no latin15, no ISO-8859-1 or ISO-8859-15. 
# UTF8!
#print json.dumps(MEM, ensure_ascii=False, encoding='utf8')
