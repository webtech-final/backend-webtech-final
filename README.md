## 1. Clone this repo and cd to project root dir

```bash
git clone https://github.com/webtech-final/backend-webtech-final.git
```

```bash
cd backend-webtech-final
```

## 2. Install package

> composer and laravel 8 require

```bash
composer install
```

## 3. Create .env file

```bash
cp .env.example .env
```

## 4. Edit .env file with text editer

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= {your database name }
DB_USERNAME= {your database username }
DB_PASSWORD= {your database password }
```

### 4.1 if you are not using http://localhost:8000/ at your host url, change this valuable (last line)

```bash
MIX_LARAVEL_END_POINT="http://localhost:8000/"
```

## 5. Generate app key

```bash
php artisan key:generate
php artisan jwt:secret
```

### 5.1 Create database with same name as 'DB_DATABASE' in .env
```bash
mysql -u {your DB username} -p
```
Enter {your DB password}
```
CREATE DATABASE {your DB name};
exit
```

### 5.2 Create symbolic link from storage/app/public/ to public/storage/

```bash
php artisan storage:link
```

## 6. Migrate table and seed record

```bash
php artisan migrate --seed
```

## 7. RUN DEV SERVE

```bash
php artisan serve
```

## NOTE
!! if use "php artisan serve" game textrue will not load use nginx or apache to host api instead

### Nginx config
add this below to nginx config file
```
add_header Access-Control-Allow-Origin *;
add_header Access-Control-Max-Age 3600;
add_header Access-Control-Expose-Headers Content-Length;
```

### Testing config
Add this to your .env file with text editer
```
DB_TESTING_HOST=127.0.0.1
DB_TESTING_PORT=3306
DB_TESTING_DATABASE= {your testing database name}
DB_TESTING_USERNAME= {your testing database username}
DB_TESTING_PASSWORD= {your testing database password}
```
Create database with same name as 'DB_TESTING_DATABASE' in .env
```
mysql -u {your testing DB username} -p
```
Enter {your testing DB password}
```
CREATE DATABASE {your testing DB name};
grant all privileges on {your testing DB name} . * to '{your testing DB username}'@'localhost';
flush privileges;
quit
```

Migrate Testing Database
```
php artisan migrate --database=mysql_testing --seed
```

Run Test Command
```
php artisan test --testsuite=Feature
```
