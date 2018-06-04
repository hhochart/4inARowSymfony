FROM debian:jessie

LABEL maintainer="guillaume.chauveau@appus.fr"

RUN apt-get update && apt-get install -y nginx

RUN rm /etc/nginx/sites-enabled/default
RUN rm /etc/nginx/sites-available/default
ADD nginx.conf /etc/nginx/
ADD ecv.conf /etc/nginx/sites-available/

# Activation des sites
RUN ln -s /etc/nginx/sites-available/ecv.conf /etc/nginx/sites-enabled/

# Fin de config nginx + lancement
RUN echo "upstream php_ecv { server ecv_cours_php:9000; }" > /etc/nginx/conf.d/upstream.conf
RUN usermod -u 1000 www-data
CMD ["nginx"]

EXPOSE 80
EXPOSE 443