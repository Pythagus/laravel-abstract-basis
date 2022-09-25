# Laravel Abstract Basis
Package to get some abstract basic tools

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Installation
You can quickly add this package in your application using Composer. **Be careful** to use the correct version of the package regarding your Laravel application version:

### Version
For now, this package supports **all Laravel versions from 5.3**.

### Composer
In a Bash terminal:
```bash
composer require pythagus/laravel-abstract-basis
```

## Usage
In this section, we will see how to use the current package features.

##### Configurations
You can configure the ```php artisan module:link``` by defining in your ```config/app.php``` file:
```php
/*
|--------------------------------------------------------------------------
| Abstract Basis module
|--------------------------------------------------------------------------
|
| This array contains the whole external modules needing a symbolic link in 
| the public folder.
| The key will be the link name.
| The value is the path to the targetted file/folder from the vendor folder.
|
*/
'modules' => [
    'bootstrap' => 'twbs/bootstrap',
],
```
The key will be the link name and the value is the path to the targetted file/folder from the ```vendor``` folder.

## Traits
This package includes some traits to help you managing your Laravel project.

##### Container
It is just a trait to resolve your repository with the method ```resolve()```.

##### Redirectable
This package uses ```laracasts/flash``` package to notify the user. You can also make quicker redirection:
```php
// Redirect back with a success or error message
$this->backSuccess("Good work!") ;
$this->backError("Sorry...") ;

// Redirect a success or error message to the given route
$this->redirectSuccess("Good work!")->route('meeting.show', $meeting) ;
$this->redirectError("Sorry...")->route('meeting.show', $meeting) ;
```

##### TryMethod
This trait helps you with the incoming exception. 
For example, your controller methods could be:
```php
public function yourMethod(Request $request) {
    return $this->try(function() use ($request) {
        // Do something with the request

        return $this->backSuccess("Good work!") ;
    }) ;
}
```
*Note :* you can use ```tryAjax()``` method in case of Ajax call.

This try is using a ```MyException``` based exception to determine whether an incoming exception is generated by Laravel or by yourself. The "trusted" exceptions won't be added to the logs, and the exception message will be added with Flash. An "untrusted" exception will be added to the logs, and the exception message will be something like "An error occurred". This message can be changed overwriting the ```weirdExceptionMessage(Throwable $throwable)``` method. 

## Architecture
This is the files architecture of the package:

```
.
├── composer.json
├── LICENSE
├── README.md
└── src
    ├── Abstracts
    │   ├── AbstractController.php
    │   ├── AbstractEvent.php
    │   ├── AbstractListener.php
    │   ├── AbstractMail.php
    │   ├── AbstractNotification.php
    │   ├── AbstractPolicy.php
    │   └── AbstractRepository.php
    ├── Events
    │   └── IncomingExceptionEvent.php
    ├── MyException.php
    ├── Redirection.php
    └── Traits
        ├── Container.php
        ├── LogException.php
        ├── Redirectable.php
        └── TryMethod.php

4 directories, 17 files
```

You can generate the previous tree using:
```bash
sudo apt install tree
tree -I '.git|vendor'
```

## Licence
This package is under the terms of the [MIT license](https://opensource.org/licenses/MIT).
