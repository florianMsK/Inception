mkdir -p /var/www/html
cd /var/www/html/
wp core download --allow-root
while ! mysqladmin -hmariadb -u${MARIADB_USER} -p${MARIADB_USERPASSWORD} ping; do
	sleep 2
done
wp config create --dbname=${MARIADB_DATABASE} --dbuser=${MARIADB_USER} --dbpass=${MARIADB_USERPASSWORD} --dbhost=mariadb:3306 --dbcharset="utf8" --dbcollate="utf8_general_ci" --allow-root
wp core install --url=${WP_URL} --title="${WP_TITLE}" --admin_user=${WP_ADMIN} --admin_password=${WP_ADMIN_PASSWORD} --admin_email="$WP_ADMIN@student.42.fr" --allow-root
wp user create ${WP_USER} "$WP_USER"@user.com --role=author --user_pass=${WP_USER_PASSWORD} --allow-root
exec "$@"
# Used to make the entrypoint a passthrough to make run after a dockercommand, "$@" is pointing points to the command line arguments (it is not creating new process = /bin/sh -c)
# https://wp-kama.com/handbook/wp-cli/wp/config for commands
