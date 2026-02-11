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

Install PHP dependencies:

```sh
composer install
```

Install Node dependencies:
```sh
cd frontend
```
```sh
npm install
```

##### Set up Database

create a database on your local mysql client with the details below

```sh
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gl
DB_USERNAME=root
DB_PASSWORD=
```

if you have any details different from above kindly update the .env details to reflect this
import the db.sql into your database using the file attached to the email

Start Backend Server

```sh
php artisan serve
```

Start Frontend Server

```sh
cd frontend
npm run dev
```

##### Testing

Kindly ensure testing is run from the root project folder
if you are in the frontend folder kindly cd back to the root folder

```sh
 ./vendor/bin/pest     
```

Api access at http://127.0.0.1:8000
visit the site at http://localhost:5173/
API Documentation https://documenter.getpostman.com/view/9861862/2sBXcAKiMf

#### Technical Decisions

Due to time I focus a bit more on backend and most of the frontend is mocked data.
I use a service pattern where most of the work is defer to the service rather than the controller.
Schema is simple to favour read over writes.
Access could be moved to Gates and Policies 


