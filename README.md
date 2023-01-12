# Simple Invoice Creator

### A Simple Invoice Creator using Laravel and Filament

 file:///home/chandraat/Pictures/Screenshots/Screenshot%20from%202023-01-12%2023-46-37.png
-44:-14:85:38

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
