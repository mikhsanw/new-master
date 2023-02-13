# SPBE Province Of Riau (v.1.0)
SISTEM PEMERINTAH BERBASIS ELECTRONIC (SPBE) PROVINSI RIAU

### Requirements
- PHP >= 8.0
- Composer >= 2.0
- Os Linux Ubuntu newest version (recommended)
- Web Server Nginx or Apache (recommended)
- Database Mysql 

### Installation
1. Clone the repository
2. Run `composer install`
3. Run `php artisan key:generate`
4. Run `copy .env.example` to `.env`
4. Create a database and configure it in `.env`
5. Run `php artisan migrate --seed`
6. Run `php artisan serve`
7. Visit `http://localhost:8000` in your browser
8. Login with `username: root password: root`
9. Enjoy!

### Special laragon-wamp web server
1. uncomment upload_tmp_dir = C:\laragon\tmp (path to laragon tmp folder) in php.ini
    - for handle error upload file
2. set path of certificate cacert.pem in php.ini (path to laragon folder)
    - for handle error guzzlehttp
    - example: curl.cainfo = "C:\laragon\bin\php\php-8.0.3-Win32-vs16-x64\extras\ssl\cacert.pem"
