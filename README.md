# Simple Invoice Creator

### A Simple Invoice Creator using Laravel and Filament

![Create Invoice](https://user-images.githubusercontent.com/64741857/212133299-b0917c86-8ff6-4d57-abbc-778ebba9697c.png)
![Create Invoice Items](https://user-images.githubusercontent.com/64741857/212133296-bc5e589b-b48d-4057-a533-5b6affe01924.png)
![PDF Invoice Example](https://user-images.githubusercontent.com/64741857/212133288-a562efc7-34c0-4318-9096-a42908380af0.png)


## Installation

1. Git clone:

```bash
git clone https://github.com/chandraauliatama/invoicecreator.git
```

2. Cd into invoicecreator directory

```bash
cd invoicecreator
```

3. Install via composer: You will get an error that vite manifest cannot be found, just keep following instructions.

```bash
composer install
```

4. Install Dependencies: You can use one of either pnpm, npm, or yarn.

```bash
npm install
```

5. Build Manifest

```bash
npm run build
```

6. Copy .env.example and configure your database:

```bash
cp .env.example .env
```

7. Generate APP_KEY for Laravel:

```bash
php artisan key:generate
```

8. Migrate the database tables to your DB:

```bash
php artisan migrate
```

9. Create new user for your app:

```bash
php artisan make:filament-user
```

10. Run Dev:

```bash
npm run dev
```
