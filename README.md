### Energy Logix

## Installation

##### Dependencies

PHP "^8.2" and composer is required to run this project on your machine.

##### Clone the repo locally:

Open a terminal or a git client and clone the project using the code below

```sh
git clone https://github.com/fredpen/EnergyL EnergyL
```

Enter into the project directory

```sh
cd EnergyL
```

### Backend

Create the env file from env example

```sh
 cp .env.example .env  
```

Install PHP dependencies:

```sh
composer install
```

##### Set up Database

There are two ways - you could use migration

```sh
php artisan migrate
```

You can also run the database seeder to get some initial data setup

```sh
 php artisan db:seed
```

or use the database dump by
creating a database on your local mysql client with the details below

```sh
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gl
DB_USERNAME=root
DB_PASSWORD=
```

if you have any details different from above kindly update the .env file to reflect this
import the db.sql into your database using the file attached to the email

Start Backend Server

```sh
php artisan serve
```

##### Testing

Ensure testing is run from the root project folder
if you are in the frontend folder kindly cd back to the root folder

```sh
 ./vendor/bin/pest     
```

### Frontend

Set up frontend

```sh
cd frontend
npm install
```

Start Frontend Server

```sh
npm run dev
```

Api access at http://127.0.0.1:8000

visit the site at http://localhost:5173/

API Documentation https://documenter.getpostman.com/view/9861862/2sBXcAKiMf

#### Technical Decisions

I focused a bit more on backend and most of the frontend is set up with mocked data.
I use a service pattern where most of the work is defer to the service rather than the controller.
Schema is simple to favour read over writes.
Access control is implemented by middleware but could be moved to Gates and Policies




