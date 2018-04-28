FROM laradock/workspace:1.1

ENV CONTAINER_PROJECT_FOLDER /var/www

RUN apt-get update && \
    apt-get install wget && \
    apt-get install -y php-mysql && \
    apt-get install -y --force-yes php7.0-xdebug && \
    sed -i 's/^/;/g' /etc/php/7.0/cli/conf.d/20-xdebug.ini && \
    echo "alias phpunit='php -dzend_extension=xdebug.so ${CONTAINER_PROJECT_FOLDER}/vendor/bin/phpunit --c ${CONTAINER_PROJECT_FOLDER}/phpunit.xml'" >> ~/.bashrc

COPY ./xdebug.ini /etc/php/7.0/cli/conf.d/xdebug.ini

COPY ./.profile /root/.profile
RUN echo "" >> ~/.bashrc && \
    echo 'source ~/.profile' >> ~/.bashrc

#--------------------------------------------------------------------------
# Laradock User
#--------------------------------------------------------------------------
RUN groupadd -g 1000 laradock && \
    useradd -u 1000 -g laradock -m laradock

COPY ./composer.json /home/laradock/.composer/composer.json
COPY ./.profile /home/laradock/.profile
RUN echo "" >> /home/laradock/.bashrc && \
    echo 'source /home/laradock/.profile' >> /home/laradock/.bashrc

RUN chown -R laradock:laradock /home/laradock/.composer
RUN chown -R laradock:laradock /home/laradock/.profile
RUN chown -R laradock:laradock /home/laradock/.bashrc

#--------------------------------------------------------------------------
# Supervisor
#--------------------------------------------------------------------------

RUN apt-get install -y supervisor

COPY ./laravel-worker.conf /tmp/laravel-worker.conf

RUN cat /tmp/laravel-worker.conf | \
sed -e "s:CONTAINER_PROJECT_FOLDER:${CONTAINER_PROJECT_FOLDER}:" \
> /etc/supervisor/conf.d/laravel-worker.conf

RUN supervisord


#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR ${CONTAINER_PROJECT_FOLDER}
ENV PATH ${CONTAINER_PROJECT_FOLDER}/vendor/bin:$PATH
