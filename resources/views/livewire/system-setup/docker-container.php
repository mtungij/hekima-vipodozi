docker run -it -d \
  --label traefik.http.routers.phamasoft.rule=Host\(\`phamasoft.com\`\) \
  --label traefik.http.routers.phamasoft.tls.certresolver=lets-encrypt \
  --label traefik.http.routers.phamasoft.tls=true \
  --label traefik.http.routers.phamasoft.service=phamasoft-credit-http \
  --label traefik.http.services.phamasoft-credit-http.loadbalancer.server.port=80 \
  --name pharmacy \
  --network web \
  --restart always \
  --expose 80 \
   mikoposoft/hekimavipodozi