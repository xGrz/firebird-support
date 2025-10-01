# Firebird for Laravel

This package adds support for the Firebird PDO Database Driver in Laravel applications.
Originally it was created by Harry Gulliford. Unfortunately, the original package is no longer maintained (doesn't support Laravel 12).
Thank you, Harry, for your work!

## Version Support

- **PHP:** 8.2, 8.3
- **Laravel:** 12.x
- **Firebird:** 2.5, 3.0, 4.0

## Installation

You can install the package via composer:

```bash
composer require xgrz/support-firebird
```

_The package will automatically register itself._

Declare the connection within your `config/database.php` file by using `firebird` as the
driver:
```php
'connections' => [

    'firebird' => [
        'driver'   => 'firebird',
        'host'     => env('DB_HOST', 'localhost'),
        'port'     => env('DB_PORT', '3050'),
        'database' => env('DB_DATABASE', '/path_to/database.fdb'),
        'username' => env('DB_USERNAME', 'sysdba'),
        'password' => env('DB_PASSWORD', 'masterkey'),
        'charset'  => env('DB_CHARSET', 'UTF8'),
        'role'     => null,
    ],

],
```

## Limitations
This package does not intend to support database migrations and it should not be used for this use case.

## Credits
- [Harry Gulliford](https://github.com/harrygulliford)

## License
Licensed under the [MIT](https://choosealicense.com/licenses/mit/) license.
