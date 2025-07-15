#!/bin/bash
echo '----------------------------------------------------------------'
echo "Code Server: https://$REPLIT_DEV_DOMAIN:8080"
echo "App Server: https://$REPLIT_DEV_DOMAIN"
echo '----------------------------------------------------------------'
./bin/cake server --host 0.0.0.0 --port 80 >/dev/null & code-server --bind-addr 0.0.0.0:8080 >/dev/null