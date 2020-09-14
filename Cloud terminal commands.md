sudo ln -s /etc/nginx/sites-available/foxtrot /etc/nginx/sites-enabled/
sudo chown -R www-data.www-data /var/www/html/storage
sudo chown -R www-data.www-data /var/www/html/bootstrap/cache
ALTER USER 'root'@'localhost' IDENTIFIED BY 'qwe';
mysql -u root -p -h 0.0.0.1 -P 3306

mysql -u root -p -h localhost -P 3306

CREATE USER 'foxtrot-user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'qweQWE123!@#';
CREATE USER 'foxtrot-user'@'%' IDENTIFIED WITH mysql_native_password BY 'qweQWE123!@#';
GRANT ALL ON foxtrot.* TO 'foxtrot-user'@'%';
mysql -u root -p -h localhost -P 3306
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'foxtrot-user'@'localhost' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'foxtrot-user'@'localhost' WITH GRANT OPTION;
sudo mysqladmin -p -u foxtrot-user version

update mysql.user set plugin = 'mysql_native_password' where user='root';
auth_socket

/etc/php/7.4/apache2/php.ini



