#!/bin/bash

hashed_pass=$(mkpasswd -m SHA-512 $2);
echo "user-$1@proxy.omb.one:{SHA512-CRYPT}$hashed_pass">> /etc/dovecot/users
