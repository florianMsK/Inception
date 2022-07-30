FROM debian:buster

LABEL Dokerimage="mariadb"

#ENV MARIADB_DATABASE=test1
#ENV MARIADB_ADMIN=Elon
#ENV MARIADB_ADMIN_PASSWORD=Musk
#ENV MARIADB_USER=Warren
#ENV MARIADB_USERPASSWORD=Buffet


RUN	apt-get update && apt-get -y upgrade && apt-get install -y mariadb-server

RUN     mkdir -p /var/run/mysqld && mkdir -p /run/mysqld
RUN     chown -R mysql:root /run/mysqld && chown -R mysql:root /var/run/mysqld
RUN     touch  /var/run/mysqld/mysqld.sock

COPY    conf/conf.sh /
COPY	conf/50-server.cnf	/etc/mysql/mariadb.conf.d/50-server.cnf

EXPOSE 3306
ENTRYPOINT  ["sh", "conf.sh"]

#mysqld_safe # For linux distributions which doesn't handle systemd 
#(systemd: default service manager which has default timeout and kill the process)
CMD ["mysqld_safe"]

