#### Installation & Running
*! Make sure file .env was created after composer installation unless create a copy from .env.example*  
*! Make sure you have configured .env file before migrations*

```sh
composer install                # Install Composer Packages
npm install                     # Install the dependencies in the local node_modules folder
npm run dev                     # Compile all your assets including into public folder
php artisan migrate             # Run database migration after you configure .env
php artisan db:seed             # Seed the database with records / All seeders in database/seeds folder
php artisan serve --port=8001   # Serve the application on the PHP development server
```

#### Database configuration
```
DB_CONNECTION=
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---
#### User credentials (test)
*! Make sure you have run the command `php artisan db:seed` before you use these credentials.*

```sh
Email:                test@test.com   
Password:             123456 
```
---
#### Directory structure
```
app/
..console/                    contains artisan commands
..exceptions/                 contains methods needed to handle exceptions
..helpers/                    contains helper data
..http/
....controllers/              contains controllers
....middleware/               contains middleware classes
....requests/                 contains form requests
....resources/                contains eloquent resources
..models/                     contains eloquent models
..providers/                  contains service providers
..servcies/                   contains service classes
..traits/                     contains traits
bootstrap/                    contains bootstrap scripts
config/                       contains configuration files
database/
..factories/                  contains model factories
..migrations/                 contains database migrations,
..seeders/                    contains seeder classes
public/                       contains the index.php file & assets
resources/                    contains views, un-compiled assets, lang files
routes/                       contains all route definitions
storage/                      contains logs, compiled blade templates, sessions, caches, and other files generated by the framework
tests/                        contains automated tests
vendors/                      contains composer dependencies
```
---
#### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
