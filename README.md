# Server Requirements

PHP >= 7.2.0
BCMath PHP Extension
Ctype PHP Extension
Fileinfo PHP extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension

Enable : allow_url_fopen

# Install

- Download and unzip files

- Configure your web server's document / web root to be the /public directory.

.htaccess example : 

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{HTTPS} !on
RewriteRule ^.*$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>

- Create config files and set your application key to a random string :

    Run this command in the home directory

    cp .env.example .env
    
    php artisan key:generate
    
- Modify env file. Change your database connection settings, website name, email settings etc.

- Install packages using composer

    php composer install
    
- Create tables in database

    php artisan migrate
    
- Run command to create a link

    php artisan storage:link
    
-  In file /app/Providers/ViewServiceProvider.php uncommentstring string 31-49

You are all done :)
