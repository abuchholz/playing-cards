FROM zzrot/alpine-node

RUN apk add --update alpine-sdk
RUN apk add --update \
    supervisor \
  && rm -rf /var/cache/apk/*

ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN /bin/mkdir -p /srv/logs

WORKDIR /srv

RUN npm install --silent socket.io
#RUN npm lodash php-unserialize ioredis node-gyp mcrypt install dotenv cookie
RUN npm dedupe

EXPOSE 6001

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]