# php_post_json

docker pull nginx

docker pull php:7.1.30-fpm

mkdir -p ~/nginx/www ~/nginx/logs ~/nginx/conf.d

echo -e ’<?php\n    phpinfo();\n?>‘ >> ~/nginx/www/index.php

在~/nginx/conf.d下配置test-php.conf

    server {

        listen       80;
        server_name  localhost;

        location / {
            root   /usr/share/nginx/html;
            index  index.html index.htm index.php;
        }

        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   /usr/share/nginx/html;
        }

        location ~ \.php$ {
            fastcgi_pass   php:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /www/$fastcgi_script_name;
            include        fastcgi_params;
        }
    }

docker run --name  myphp7 -v ~/nginx/www:/www  -d php:7.1.30-fpm

docker run --name runoob-php-nginx -p 8083:80 -d \
    -v ~/nginx/www:/usr/share/nginx/html:ro \
    -v ~/nginx/conf.d:/etc/nginx/conf.d:ro \
    --link myphp7:php \
    nginx
