# Laravel Booking Game
Laravel Booking Game is an open-source web application built with laravel 9.0, enchanced with laravel websockets features to have realtime notification experience.


## Environmental requirements
- php version 8.1
- mysql version > 8.0


## Examples
- Reservation
  ![alt text](https://user-images.githubusercontent.com/57338392/185278745-b9729f50-0f06-4d59-96da-c357f225ee40.png)
- Dashboard admin
  ![alt text](https://user-images.githubusercontent.com/57338392/185278997-031c9f61-98bd-4440-864e-e86f45c49d29.png)
- Dashboard gamer
  ![alt text](https://user-images.githubusercontent.com/57338392/185024460-7f8524b3-e6d4-46c6-91dd-a8d26a4d29e9.png)
- And more ...


## Instalation

### Init DB
- Create DB Name: booking
  or via terminal
```
mysql -u root -p
```
enter your db credential
```
create database booking;
exit;
```
## How to install project
### Init Commands:
Run
```
sh install.sh
```
or
```
composer install &&
composer update &&
php8.1 artisan key:generate &&
npm install && npm run dev &&
php8.1 artisan migrate &&
php8.1 artisan db:seed &&
php8.1 artisan storage:link &&
mkdir -p storage/framework/cache/data &&
php8.1 artisan route:clear &&
php8.1 artisan cache:clear &&
php8.1 artisan config:clear &&
php8.1 artisan view:clear
```

### Login:
- Email: admin@gmail.com
- Password: admin123

## Module
- Dashboard
    - Guests Chart
    - Guests on this day

- Transaction
    - Payment
        - Create & Store Payment
        - Payment History
    - Game Reservation
        - Admin booking:
            1. Choose Customer:
                - Create New Customer / Pick from existing Customer
            2. Input Form:
                - How many people
                - Date for Check In
                - Date for Check Out
            3. Pick Available Game:
                - Check unoccupied Game between date Check in and Check out.
                - Game Capacity must be > than input how many people.
            4. Confirmation & Down Payment
                - Down Payment: 15% of total price
                - Payment must be equal or higher than Down Payment
            5. If the transaction Success:
                - Send Email notification to Super Role about transaction payment.
                - Send push notification to Super Role.
                - Update all dashboard view

        - Gamer booking:
            1. Input Form:
                - How many people
                - Date for Check In
                - Date for Check Out
            2. Pick Available Game:
                - Check unoccupied Game between date Check in and Check out.
                - Game Capacity must be > than input how many people.
            3. Confirmation & Down Payment
                - Down Payment: 15% of total price
                - Payment must be equal or higher than Down Payment
            4. If the transaction Success:
                - Send Email notification to Super Role about transaction payment.
                - Send push notification to Super Role.
                - Update all dashboard view

- CUSTOMER Management
    - Create Customer
    - Read Customer
        - Paginate
        - Search
    - Update Customer
    - Delete Customer
        - Cannot be deleted if the customer has transaction
    - Customer Detail

- USER Management
    - Create User
    - Read User (Super, Admin)
        - Paginate
        - Search
    - Read User (Customer)
        - Paginate
        - Search
    - Update User
    - Delete User
        - Cannot be deleted if the User has transaction
    - User Detail

- Game Management
    - Create Game
    - Read Game
        - Paginate
        - Search
    - Update Game
    - Delete Game
        - Cannot be deleted if the Game already connected in transaction
    - Game Detail

- CRUD Game TYPE
    - Create Game Type
    - Read Game Type
        - Paginate
        - Search
    - Update Game Type
    - Delete Game Type

- CRUD Game STATUS
    - Create Game Status
    - Read Game Status
        - Paginate
        - Search
    - Update Game Status
    - Delete Game Status


## Laravel License

Laravel booking game project is open source software developed by the company [WGT](https://wgentech.com/).
