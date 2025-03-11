<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Car Manager
This is a demonstration of a CRUD made with Laravel framework (also using Blade), where it can be used 
with users in a website or developers as an API. Let me show you how its works!

## Demo
Url video: [Click here](https://drive.google.com/file/d/15WcxPRzHyjPL5HRgX4onwEMp0AHAYeNe/view?usp=sharing)

## Features
- CRUD implemented as API and web integration
- Filtering by brand and/or model
- Table with 5 records per page
- Pagination will be activated when cars are more than 5
- SweetAlert modals when user has created, updated or confirm deletion
- Validation messages when inputs are not filled correctly
- Website designed with Bootstrap

## Previous requirements
- Have the development environment installed to run PHP, the options more used are XAMPP or WampServer
- Node JS installed, even if the main language managed here is PHP.
- Composer as package manager that's necessary to work with PHP and in this case with Laravel.
- MySQL is used in this project, also you need to create a database name `car-manager` and change the credentials in the project
- Have Visual Studio Code, PHP Storm or any other code editor that you can work with Laravel
- Laravel CLI installed (optional)

## Project Installation
1. Clone this repository inside `htdocs` folder if you are using XAMPP or `www` folder if you are using WampServer.
2. Install node packages using the command: `npm install`
3. Create database in MySQL: 
Go to the command interpreter with a user (in my case I used root without password `mysql -uroot`). When you can see `mysql>` as prompt, execute the following command:
```mysql
CREATE DATABASE `car-manager`;
```
4. Donwnload .env file and change database credentials according your information:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car-manager
DB_USERNAME=root
DB_PASSWORD=
```
5. Make migration of tables using the command: `php artisan migrate`
6. Verify if Car table was created, go to command interpreter and execute the following commands:
- `SHOW DATABASES;` and select your DB with `USE car-manager;`
- `SHOW TABLES;` and you should see a table named `cars`
-  When you have registered cars, you can see them with `SELECT * FROM cars;`. Currently I have the following records in my DB:
```mysql
+----+-----------+----------+------+----------+---------+---------------------+---------------------+
| id | brand     | model    | year | color    | price   | created_at          | updated_at          |
+----+-----------+----------+------+----------+---------+---------------------+---------------------+
| 27 | Peugeot   | 206      | 2013 | Plateado | 4800.00 | 2025-03-09 14:09:38 | 2025-03-09 14:09:57 |
| 28 | Renault   | Clio     | 2010 | Rojo     | 3700.00 | 2025-03-09 14:12:50 | 2025-03-09 14:12:50 |
| 29 | Chevrolet | Spark GT | 2017 | Azul     | 4200.00 | 2025-03-09 14:14:16 | 2025-03-09 17:34:32 |
| 30 | Renault   | Sandero  | 2017 | Plateado | 4700.00 | 2025-03-09 14:23:37 | 2025-03-09 14:23:37 |
| 31 | Chevrolet | Spark    | 2012 | Rojo     | 3200.00 | 2025-03-09 17:26:12 | 2025-03-09 17:26:29 |
| 32 | Nissan    | Kicks    | 2020 | Blanco   | 6200.00 | 2025-03-09 17:31:07 | 2025-03-09 17:31:07 |
+----+-----------+----------+------+----------+---------+---------------------+---------------------+
```
7. Finally, you can run the application with `php artisan serve`. The local server should be running on http://127.0.0.1:8000

## Website usage
After started the server, you can access to the website `http://localhost:8000/cars`. 
You can see the index page and interact with this.

### Add a new car
1. Create a new car clicking on the Add Car button
2. Fill the form with according info (each field have validations)
3. When all info were filled. Add a new car clicking on the Save button
4. You will see a message if it was successful and return to table view

### Update a Car
1. Click on update button in the record of the table (action column) that you want to change information
2. Update info from fields that you want to change in the form 
3. When all be ready. Update car clicking on the Update button
4. You will see a message if it was successful and return to table view

### Delete a Car
1. Click on delete button in the record of the table (action column) that you want to delete
2. Confirm if you really want to delete that car or cancel
3. You will see a message if it was successful and return to table view

### Filter usage
1. Type on brand field and/or model field the info with that you want to search
2. Click on Search button and you'll see the filtered cars. Otherwise, you'll see a no records message in the table
3. Click on the Clear button to refresh and load the first page of the table, also the filters fields are cleaned
4. If exists more than 5 records, the paginator will be activated and you can navigate between pages.

## API Usage

After started the server, you can use the following routes with their values 
through Postman, CURL command or others ways:

```bash
# Local url
http://localhost:8000/api
```

### Select all existing cars
Show all cars registered in cars table
- Route:`/api/cars`
- Type: `GET`
- Query: N/A
- Params: N/A
- Body: N/A

#### Success
- Status: `200` (Even if data is empty)
```JSON
{
    "current_page": 1,
    "data": [
        {
            "id": 32,
            "brand": "Nissan",
            "model": "Kicks",
            "year": 2020,
            "color": "Blanco",
            "price": "6200.00",
            "created_at": "2025-03-09T17:31:07.000000Z",
            "updated_at": "2025-03-09T17:31:07.000000Z"
        },
        ...More
    ],
    "first_page_url": "http://localhost:8000/api/cars?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://localhost:8000/api/cars?page=2",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/cars?page=1",
            "label": "1",
            "active": true
        },
        ...More
    ],
    "next_page_url": "http://localhost:8000/api/cars?page=2",
    "path": "http://localhost:8000/api/cars",
    "per_page": 5,
    "prev_page_url": null,
    "to": 5,
    "total": 6
}
```

#### Failure
- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

### Select cars from filter
Show cars registered in cars table according values from brand and model params
- Route: `/cars?brand=:brand&model=:model`
- Type: `GET`
- Query: `brand`, `model`
- Params: N/A
- Body: N/A

#### Success
- Status: `200` (Even if data is empty)
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 28,
            "brand": "Renault",
            "model": "Clio",
            "year": 2010,
            "color": "Rojo",
            "price": "3700.00",
            "created_at": "2025-03-09T14:12:50.000000Z",
            "updated_at": "2025-03-09T14:12:50.000000Z"
        }
    ],
    "first_page_url": "http://localhost:8000/api/cars?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/cars?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/cars?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:8000/api/cars",
    "per_page": 5,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

#### Failure
- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

### Select a Car by Id

Select a unique car according their id 
- Route: `/cars/:id`
- Type: `GET`
- Query: N/A
- Params: `id`
- Body: N/A

#### Success
- Status: `200`
```json
{
    "id": 30,
    "brand": "Renault",
    "model": "Sandero",
    "year": 2017,
    "color": "Plateado",
    "price": "4700.00",
    "created_at": "2025-03-09T14:23:37.000000Z",
    "updated_at": "2025-03-09T14:23:37.000000Z"
}
```
#### Failure
- Status: `404`
```json
{
    "message": "Car not found.",
    "error": " - Error description from Laravel - "
}
```

- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

### Add a new car

Create a car, this validates information of every field. If is not correct an error will be launched 
- Route: `/cars`
- Type: `POST`
- Query: N/A
- Params: N/A
- Body: 
```json
{
    "brand": "Toyota",
    "model": "Hilux",
    "year": 2019,
    "color": "Blanco",
    "price": "7500.00"
}
```

#### Success
- Status: `201`
```json
{
    "brand": "Toyota",
    "model": "Hilux",
    "year": 2019,
    "color": "Blanco",
    "price": "7500.00",
    "updated_at": "2025-03-08T21:05:24.000000Z",
    "created_at": "2025-03-08T21:05:24.000000Z",
    "id": 23
}
```

#### Failure
- Status: `400`
```json
{
    "message": "Bad request",
    "errors": {
        "year": [
            "The year field is required."
        ],
        "price": [
            "The price field must not be greater than 99999."
        ]
    }
}
```

- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

### Update a Car

Update info from a car, this validates information of every field. If is not correct an error will be launched
- Route: `/cars/:id`
- Type: `PUT`
- Query: N/A
- Params: `id`
- Body: 
```json
{
    "brand": "Renault",
    "model": "Sandero",
    "year": 2018,
    "color": "Plateado",
    "price": "4700.00"
}
```

#### Success
- Status: `200`
```json
{
    "message": "Car updated successfully.",
    "data": {
        "id": 30,
        "brand": "Renault",
        "model": "Sandero",
        "year": 2018,
        "color": "Plateado",
        "price": "4700.00",
        "created_at": "2025-03-09T14:23:37.000000Z",
        "updated_at": "2025-03-09T23:11:44.000000Z"
    }
}
```

#### Failure
- Status: `400`
```json
{
    "message": "Bad request",
    "errors": {
        "year": [
            "The year field is required."
        ],
        "price": [
            "The price field must not be greater than 99999."
        ]
    }
}
```
- Status: `404`
```json
{
    "message": "Car not found.",
    "error": " - Error description from Laravel - "
}
```

- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

### Update a Car

Removes a car according their id 
- Route: `/cars/:id`
- Type: `DELETE`
- Query: N/A
- Params: `id`
- Body: N/A

#### Success
- Status: `200`
```json
{
    "message": "Car deleted successfully.",
    "data": {
        "id": 26,
        "brand": "Chevrolet",
        "model": "Spark",
        "year": 2015,
        "color": "Azul Oscuro",
        "price": "4500.00",
        "created_at": "2025-03-09T14:06:57.000000Z",
        "updated_at": "2025-03-09T14:06:57.000000Z"
    }
}
```

#### Failure
- Status: `404`
```json
{
    "message": "Car not found.",
    "error": " - Error description from Laravel - "
}
```

- Status: `500`
```JSON
{
    "message": "Internal server error.",
    "error": " - Error description from Laravel - "
}
```

## Author
- Cristian Pinzón - faykris28@gmail.com
