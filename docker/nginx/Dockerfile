
FROM nginx:1.21-alpine as dev

# GET local nginx config
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /app

FROM dev as prod

COPY ./public /app/dette/public