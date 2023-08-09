FROM nginx:stable-alpine

ENV NGINXUSER=convertedin
ENV NGINXGROUP=convertedin

RUN mkdir -p /var/www/html

ADD nginx/default.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/user www-data/user ${NGINXUSER}/g" /etc/nginx/nginx.conf

RUN adduser -g ${NGINXGROUP} -s /bin/sh -D ${NGINXUSER}