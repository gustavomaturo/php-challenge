# api-challenge

## Back-End

- [Laravel] (https://laravel.com/)
- [Laravel Doctrine] (http://www.laraveldoctrine.org/)
- [Composer] (https://getcomposer.org/)
- [MySQL] (https://www.mysql.com/)

# Project Execution

- Install [Composer](https://getcomposer.org/), [Laravel](https://laravel.com/) and [XAMPP](https://www.apachefriends.org/pt_br/index.html) (MySQL);
- Clone the repository;
- Enter the folder via the terminal;
- Download depedencies **composer install**;
- Run script databse **database/challenge.sql**
- Run the project **php artisan serve**;
- Enter the folder **upload** for examples file upload

# Endpoints - People

- GET: http://127.0.0.1:8000/api/people
    Return: {success: true or false, data => []}

- POST: http://127.0.0.1:8000/api/people
    Return: {message: ''}
    
- DELETE: http://127.0.0.1:8000/api/people/{id}
    Return: {message: ''}
    
# Endpoints - Ship Order

- GET: http://127.0.0.1:8000/api/ship
    Return: {success: true or false, data => []}
    
- POST: http://127.0.0.1:8000/api/ship
    Return: {message: ''}
    
- DELETE: http://127.0.0.1:8000/api/ship/{id}
    Return: {message: ''}