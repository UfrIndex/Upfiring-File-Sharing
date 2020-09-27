# Install

- Download and unzip files
- You should configure your web server's document / web root to be the public directory.
- You should create config file and set your application key to a random string. Run  command in home directory

    cp .env.example .env
    
    php artisan key:generate
    
-  Modify env file. Change your database connection settings, etc.
- Install packages using composer

    php composer install
    
- Create tables in database

    php artisan migrate
    
- Run command to create a link

    php artisan storage:link
    
-  In file /app/Providers/ViewServiceProvider.php uncommentstring string 31-49
