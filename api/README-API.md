# api-challenge

## Back-End

- [Laravel] (https://laravel.com/)
- [Laravel Doctrine] (http://www.laraveldoctrine.org/)
- [Composer] (https://getcomposer.org/)

# Project Execution

- Clone the repository;
- Enter the folder via the terminal;
- Download depedencies **composer install**;
- Run script databse database/challenge.sql
- Run the project **php artisan serve**;


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