FROM nginx:1.21.5 as app-http-prod

COPY docker/app-http/nginx.conf /etc/nginx/

RUN mkdir -p /var/www/public

COPY assets /var/www/public/assets
