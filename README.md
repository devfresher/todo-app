## Seting up the project

The app is a simple todo app with the basic CRUD endpoints. Below is how to set upt the appliation locally.

- Clone the  project
- Go to the folder application using cd command on your cmd or terminal
- Run `composer install` on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- pen your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Go to http://localhost:8000/



## Available Endpoints

### BASES URL
If the instructions above are followed the base URL should be http://localhost:8000/api/

### Create Task
Endpoint: create-task
Method: POST

### Get All Tasks
Endpoint: tasks
Method: GET

### Get Single Tasks
Endpoint: task/{id}
Method: GET

### Complete a Task
Endpoint: complete/{id}
Method: PUT

### Uncomplete a Task
Endpoint: incomplete/{id}
Method: PUT

### Update a Task
Endpoint: tsak/{id}
Method: PUT

### Remove a Task
Endpoint: tsak/{id}
Method: DELETE
