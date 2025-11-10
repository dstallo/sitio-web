# Dialisis
Sitio web de Froebel

## Dependencias / Requisitos
```sh
- PHP ^7.4
- MySQL con autenticación mysql_native_password: CREATE USER '...'@'localhost' IDENTIFIED WITH mysql_native_password BY '...'
```
## Paso a paso
```sh
- Configuración .env
-- Base de datos.
-- SMTP & Email para formulario de contacto.
$ composer install
$ php artisan key:generate
$ php artisan migrate:refresh --seed
$ php artisan storage:link
```
