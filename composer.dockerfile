FROM composer:2



ENV COMPOSERUSER=convertedin
ENV COMPOSERGROUP=convertedin

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}