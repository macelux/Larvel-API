

<b>Ecommerce API</b>

This is an ecommerce API which can be used to manage orders , users , products and  reviews  , An Admin dashboard is also included to allow administrators interact with the application <br/>

<b>Installation</b>

1. Clone the    repository


2. Change directory into the folder that contains the repository

3. Run composer install if you have any errors , delete the vendor folder run composer install again and there will be no errors

4. Install NPM Dependencies -   npm install

5. Create a copy of your .env file - cp .env.example .env

6. Generate an app encryption key - php artisan key:generate

7. Create a new database for the application and let its name match with the name in the .env file
 
9. Migrate tables to the database - php artisan migrate

10. Start the application - php artisan serve


