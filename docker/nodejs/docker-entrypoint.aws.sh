#!/bin/bash

cd /var/www/Frontend && pm2 start npm --name "nuxt" -- start
cd /var/www/Nuxtjs && pm2 start npm --name "nuxt" -- start
node
