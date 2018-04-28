FROM nginx:alpine

ARG SITE_DOMAIN
ENV SITE_DOMAIN ${SITE_DOMAIN}
ARG TEST_DOMAIN
ENV TEST_DOMAIN ${TEST_DOMAIN}

ADD nginx.conf /etc/nginx/

ADD template.conf /tmp/

RUN cat /tmp/template.conf | \
sed -e "s/SITE_DOMAIN/${SITE_DOMAIN}/" | \
sed -e "s/TEST_DOMAIN/${TEST_DOMAIN}/" \
> /tmp/laravel.conf

RUN mkdir /etc/nginx/sites-available/
RUN cp /tmp/laravel.conf /etc/nginx/sites-available/


RUN apk update \
    && apk upgrade \
    && apk add --no-cache bash \
    && adduser -D -H -u 1000 -s /bin/bash www-data \
    && rm /etc/nginx/conf.d/default.conf \
    && echo "upstream php-upstream { server php-fpm:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["nginx"]

EXPOSE 80 443
