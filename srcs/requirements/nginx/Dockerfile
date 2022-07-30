FROM debian:buster

LABEL Dokerimage="nginx"
# Here we are just updating all packages of nginx and creating a folder for the keys 
# We are using openssl whitch is the library where ssl is into
RUN     apt-get update 
RUN     apt-get -y upgrade
RUN     apt-get install -y nginx openssl

RUN mkdir -p /etc/nginx/ssl

# Use openssl to generate a self signed certificate, it contains the public key portion of the private key
# and also information about us the rsa 4096 provides better security and and slighty higher performance
# We have a real self signed certificate thanks to x506 which indicate a self generating certificate request
# req is for use of x509/ sha is security, node skip option to secure certificate
RUN openssl req -newkey rsa:4096 -x509 -sha512 -days 365 -nodes \ 
	-out /etc/nginx/ssl/nginx.crt \
	-keyout /etc/nginx/ssl/nginx.key  \
	-subj "/C=FR/ST=Paris/L=nowhere/O=flCompany/CN=flmastor.42.fr"

EXPOSE 443
COPY ./nginx.conf /etc/nginx/conf.d/default.conf
CMD ["nginx", "-g", "daemon off;"]

# (1) Self signed : https://codingwithmanny.medium.com/configure-self-signed-ssl-for-nginx-docker-from-a-scratch-7c2bcd5478c6

# (2) For running [CMD] Nginx: https://www.baeldung.com/linux/nginx-docker-container

