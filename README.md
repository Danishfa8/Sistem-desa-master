# Sistem Desa Pintar Brebes

### Instalation Demo (Local)

-   clone this repository
-   cp.env.example .env (copy environtment variable)
-   config the DB Connection
-   `composer install`
-   `php artisan key:generate`
-   `php artisan migrate:fresh`
-   `php artisan db:seed --class=AdminSeeder`
-   `php artisan db:seed --class=SettingwebSeeder`
-   `php artisan db:seed --class=KecamatanSeeder`
-   `php artisan db:seed --class=DesaSeeder`
-   `php artisan db:seed --class=DatabaseSeeder`

### User Account

-   superadmin@gmail.com (superadmin)
-   admin_desa@gmail.com (admindesa)
-   admin_kab@gmail.com (adminkab)
