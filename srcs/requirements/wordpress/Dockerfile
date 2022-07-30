FROM debian:buster

LABEL Dockerimage="wordpress"

RUN apt-get update -y
RUN apt-get install -y  php7.3-cli php7.3-common php7.3-curl php7.3-mbstring php7.3-mysql php-fpm curl mariadb-client wget 
#sendmail
RUN 	mkdir -p /var/run/ ; mkdir -p /run/php/

COPY ./conf/www.conf /etc/php/7.3/fpm/pool.d
COPY ./conf/wp-config.php /var/
COPY ./conf/confManager.sh /etc/

RUN chmod +x /etc/confManager.sh

# Lancement du script
RUN 	curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
		chmod +x wp-cli.phar && \
		mv wp-cli.phar /usr/local/bin/wp

EXPOSE 9000
ENTRYPOINT [ "bash", "/etc/confManager.sh" ]
CMD ["/usr/sbin/php-fpm7.3", "--nodaemonize"]

#For all php services: https://sys-admin.fr/installation-php-7-3-sur-debian/
# All we do here is to install all tools and installation assistance. .phar = file format to stock php packets
# php fpm is for the Fastcgi 
