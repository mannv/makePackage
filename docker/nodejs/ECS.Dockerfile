FROM node:lts-alpine

#The host is set to 0.0.0.0 to give full external access to the app container.
ENV HOST 0.0.0.0

ENV APP_ROOT /var/www

RUN apk add bash \
    && apk add nano \
    && apk add make \
    && apk add curl

WORKDIR ${APP_ROOT}

ADD ./docker-entrypoint.aws.sh /docker-entrypoint.sh

#################################
#####   install pm2         #####
#################################
RUN npm install pm2 -g

#-------------------------------------------------------------------
#       config for ECS environment

ADD ./src/Nuxtjs /var/www/Nuxtjs
ADD ./src/Frontend /var/www/Frontend

#download translate from https://github.com/cw-hrtech/vitop-translate/
RUN apk add curl
RUN curl https://raw.githubusercontent.com/cw-hrtech/vitop-translate/master/en.json -o /var/www/Frontend/locales/en.json
RUN curl https://raw.githubusercontent.com/cw-hrtech/vitop-translate/master/vi.json -o /var/www/Frontend/locales/vi.json

RUN curl https://raw.githubusercontent.com/cw-hrtech/vitop-translate/master/en.json -o /var/www/Nuxtjs/locales/en.json
RUN curl https://raw.githubusercontent.com/cw-hrtech/vitop-translate/master/vi.json -o /var/www/Nuxtjs/locales/vi.json

WORKDIR /var/www/Nuxtjs
RUN npm i --only=prod
## build production
RUN rm -f env.json && cp env.prod.json env.json && npm run build && mv .nuxt .nuxt_prod
## build staging
RUN rm -f env.json && cp env.staging.json env.json && npm run build && mv .nuxt .nuxt_staging
## build test
#RUN rm -f env.json && cp env.test_ci.json env.json && npm run build

WORKDIR /var/www/Frontend
RUN npm i --only=prod
## build production
RUN rm -f env.json && cp env.prod.json env.json && npm run build && mv .nuxt .nuxt_prod
## build staging
RUN rm -f env.json && cp env.staging.json env.json && npm run build && mv .nuxt .nuxt_staging
## build test
#RUN rm -f env.json && cp env.test_ci.json env.json && npm run build
#-------------------------------------------------------------------

WORKDIR /var/www

CMD ["/docker-entrypoint.sh"]

EXPOSE 3000 3001
