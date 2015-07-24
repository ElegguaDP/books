Yii 2 Test Project
==================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Clone project from GitHub

~~~
git clone https://github.com/ElegguaDP/books.git
~~~

### Install via Composer

Run this command in project base directory
~~~
php composer.phar update
~~~

Now you should be able to access the application through the following URL, assuming `books` is the directory
directly under the Web root.

~~~
http://localhost/books/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** You must create the database manually. Use the MySQL-file ```books.sql``` into base directory.
