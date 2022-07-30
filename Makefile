all: 
	@ sudo mkdir -p /home/flmastor/data/mariadb_vol/
	@ sudo mkdir -p /home/flmastor/data/wordpress_vol/
	@ sudo docker-compose -f ./srcs/docker-compose.yml up -d --build

up:
	@ sudo docker-compose -f ./srcs/docker-compose.yml up -d
	
down:
	@ sudo docker-compose -f ./srcs/docker-compose.yml down

clean: down
	@ sudo docker container prune; 

fclean: clean
	@ sudo rm -rf /home/flmastor/data/mariadb_vol
	@ sudo rm -rf /home/flmastor/data/wordpress_vol
	@ docker system prune -a

re: fclean all

.PHONY: up down clean fclean re all

