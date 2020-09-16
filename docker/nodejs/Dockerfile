FROM node:lts-alpine

#The host is set to 0.0.0.0 to give full external access to the app container.
ENV HOST 0.0.0.0

ENV APP_ROOT /var/www

RUN apk add bash \
    && apk add nano \
    && apk add make \
    && apk add curl

WORKDIR ${APP_ROOT}

ADD ./docker-entrypoint.sh /docker-entrypoint.sh

#################################
#####   install pm2         #####
#################################
RUN npm install pm2 -g

CMD ["/docker-entrypoint.sh"]

EXPOSE 3000 3001
