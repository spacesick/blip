# Blip

## Running locally

Make sure you have PHP 8.2, Composer, Node.js, and NPM (or any other Node package manager you desire) installed on your machine.

1. Clone the repo.
2. Create a `.env` file in the root project directory using `.env.example`.
3. Create a mysql database. You can use XAMPP here.
4. Run the following commands,

    ```bash
    composer install
    npm install
   
    npm run build # or npm run dev
   
    php artisan key:generate
   
    php artisan migrate:fresh --seed
    php artisan storage:link
   
    php artisan serve --port=8000
    ```

## Information

Default seeded user credentials:
- email: test@example.com
- password: terminal

When entering a transaction amount, append a `.00`, e.g. `100.00`.
