

<b>Ecommerce API</b>

This is an ecommerce API which can be used to manage orders , users , products and  reviews  , An Admin dashboard is also included to allow administrators interact with the application <br/>

<b>Installation</b>

1. Clone the    repository


2. Change directory into the folder that contains the repository
   ```sh
   cd folder name
   ```

3. install  composer 
    ```sh
     composer  install
    ```
4. Install NPM Dependencies -   npm install
     ```sh
      npm install
    ```
5. Create a copy of your .env file 
    ```sh
      cp .env.example .env
    ```
6. Generate an app encryption key
    ```sh
       php artisan key:generate
    ```

7. Create a new database for the application and let its name match with the name in the .env file
 

8. Migrate tables to the database - php artisan migrate
    ```sh
       php artisan migrate
    ```
    
9. You can seed the database with the default seeders included
    ```sh
       php artisan db:seed
    ```

10. Start the application 
    ```sh
        php artisan serve
    ```


