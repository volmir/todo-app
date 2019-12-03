# ToDo application

### Install

```sh
$ cd /path/to/htdocs
$ git clone https://github.com/volmir/todo-app.git
$ composer install
```

Virtual host example (Apache):

```apache
<VirtualHost *:80>
    <Directory "/var/www/todo-app">
        AllowOverride All
    </Directory>
    ServerName todo.app.local
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/todo-app/web
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Virtual host example (Nginx):

```nginx
server {
    listen 80;
    root /var/www/todo-app/web;
    index index.php index.html;

    server_name todo.app.local;

    location / {
	try_files $uri /index.php$is_args$args;
    }

    location ~ ^/(index)\.php(/|$) {
	fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
	fastcgi_split_path_info ^(.+\.php)(/.*)$;
	include fastcgi_params;

	fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
	fastcgi_param DOCUMENT_ROOT $realpath_root;
    }

    location ~ /\.ht {
	deny all;
    }
}
```   


### RedBeanPHP ORM

https://www.redbeanphp.com/index.php
https://prowebmastering.ru/redbeanphp-orm-dlya-php.html


