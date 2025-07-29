#!/bin/bash
echo '----------------------------------------------------------------'
echo "Code Server: https://$REPLIT_DEV_DOMAIN:8080"
echo "App Server: https://$REPLIT_DEV_DOMAIN"
echo '----------------------------------------------------------------'
./bin/cake server --host 0.0.0.0 --port 80 >/dev/null & code-server --bind-addr 0.0.0.0:8080 >/dev/null

echo $(curl -v -X POST \
    -H "Content-Type: application/json" \
    -H 'X-Requested-With: XMLHttpRequest' \
    -H 'Authorization: Token rrrr' \
    -H 'Accept: application/json' \
    -H 'X-My-Custom-Header: hijames' \
    -d @content.json \
    http://localhost:8080/articles/ajax)