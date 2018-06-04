FROM node:latest

LABEL maintainer="guillaume.chauveau@appus.fr"

# Installation Yarn
RUN curl -o- -L https://yarnpkg.com/install.sh | bash
RUN yarn add @symfony/webpack-encore --dev
RUN yarn add sass-loader node-sass --dev
RUN yarn add webpack-notifier --dev

RUN useradd -ms /bin/bash dev
RUN chown -R dev: /home/dev
ENV HOME /home/dev

VOLUME /home/dev

WORKDIR /var/www/ecv.sf

CMD ["tail", "-F", "-n0" ,"/etc/hosts"]