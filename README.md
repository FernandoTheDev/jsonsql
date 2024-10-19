# JsonSQL - A terrible database

[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-blue)](https://www.php.net/)
[![Code style](https://img.shields.io/badge/code%20style-standard-green)](https://www.php-fig.org/psr/psr-2/)
[![License](https://img.shields.io/badge/license-MIT-green)](https://github.com/badfarm/zanzara/blob/develop/LICENSE.md)

---

**JsonSQL** is a way to use json as a database in testing or really small projects. **No IO control, no advanced logging system or anything like that.**

If you want to use it, use it. You don't need to configure anything and it's super simple to use.

## Problems

I believe that json is not good, and I believe that php is not ideal, there are problems like 2 requests and changing the file at the same time. Let's say someone changes the file and 0.01s later another person changes other information, the file has not yet been saved, I mean, if it is too wide it will certainly not have been saved in that time and will soon corrupt the data edited at 0.01s. Therefore, only use it if it is really for testing, or something very specific.

### Instalation

With composer install with the command:

```bash
composer require fernandothedev/jsonsql
```

### Usage

The target json file must have at least open braces.

``` 
file.json: {}
```

### Class

Use the class using the **Fernando\\\JsonSQL** namespace:

```php
<?php

use Fernando\\JsonSQL;

require_once __DIR__ . '/path/from/autoload.php';

$file = __DIR__ . '/path/from/file.json';

$jsonsql = new JsonSQL($file);
```

### Insert

```php
// return true
$jsonsql->insert(key: 'fernandothedev', array: [
    'name' => 'Fernando',
    'age' => 16,
    'love' => 'php'
]);
```

### Select

```php
// return false [ user not exists ]
var_dump($jsonsql->select(key: 'fernando'));

// return array [ user exists ]
print_r($jsonsql->select(key: 'fernandothedev'));

// return array<T>
var_dump($jsonsql->select(key: 'fernandothedev', array: [
    'name'
]));
```

### Update

```php
// return true { update [ unic user ] }
$jsonsql->update(key: 'fernandothedev', array: [
    'love' => 'water'
]);

sleep(seconds: 3);

// retur true { update [ all users ] }
var_dump($jsonsql->update(array: [
    'love' => 'money'
]));
```

### Delete

```php
// return false [ user not exists ]
$jsonsql->delete(key: 'fernando2');

// return false [ key not exists ]
$jsonsql->delete(key: 'fernando', array: [
    'key-dont-exists'
]);

// return true [ user deleted ]
$jsonsql->delete(key: 'fulano');

// return true { user [ key deleted ] }
$jsonsql->delete(key: 'fernandothedev', array: [
    'love'
]);
```

### Structure

**Always leave the columns** the same, if a **user** has **name**, **age** and other columns, all other users must have them too, to avoid errors.

```json
{
    "my-user": {
        "key": "value"
    },
    "my-other-user": {
        "key": "value"
    }
}
```

Bye!
