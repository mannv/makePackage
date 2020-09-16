#!/bin/bash

env=$1

DOMAIN_FRONTEND="www.vitop.vn"
DOMAIN_EMPLOYER="employer.vitop.vn"
if [ $env = 'local' ]; then
    DOMAIN_FRONTEND="local.vitop-career.com"
    DOMAIN_EMPLOYER="employer.local.vitop-career.com"
elif [ $env = 'staging' ]; then
    DOMAIN_FRONTEND="staging.vitop.vn"
    DOMAIN_EMPLOYER="employer-staging.vitop.vn"
fi

sed -i "s/__server_name__/${DOMAIN_FRONTEND}/g" "/etc/nginx/sites-available/frontend.conf"
sed -i "s/__server_name__/${DOMAIN_EMPLOYER}/g" "/etc/nginx/sites-available/employer.conf"

# Start nginx in foreground
nginx
