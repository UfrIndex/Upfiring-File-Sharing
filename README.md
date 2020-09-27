# Upfiring File Sharing 

- User Management ( Administrator / Moderator / Contributor )
- Pages Menagment 
- Footer / Header custom script support ( Google Analytics, Ads Code etc )
- Upfiring File Managmeent ( File Moderation, Listing etc )
- Comments Menagmenet 
- Advertising Panel : Top Banner / Side Banners / Announcment Box
- Website Options ( Title , Description , Front Page menagment etc )

Complete UFR File Support + Integrated S/L scraper to display the correct Seeders/Leechers numbers on each file. S/L numbers are updated on each link view / or via cron job which is explained bellow.

# Server Requirements

PHP >= 7.2.0

BCMath PHP Extension

Ctype PHP Extension

Fileinfo PHP extension

JSON PHP Extension

Mbstring PHP Extension

OpenSSL PHP Extensio

PDO PHP Extension

Tokenizer PHP Extension 

XML PHP Extension

Apache Enable : allow_url_fopen

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

-   Add Cron Job to autoupdate S/L numbers automaticly 

        /2    * curl -s "https://domain.com/cron_update" > /dev/null

You are all done :)

# Want to Support us ?

BTC Donation Address : 1G5bG9W1NmyJ6ww8GWsK9GJzJy3NhB2Lv5

UFR Donation Address : 0x498A2A9F3C8e58eABd71C3F0624ceE34Fd671aFd

ETH Donation Address : 0x498A2A9F3C8e58eABd71C3F0624ceE34Fd671aFd 
