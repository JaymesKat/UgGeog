[![CircleCI](https://circleci.com/gh/JaymesKat/UgGeog.svg?style=svg)](https://circleci.com/gh/JaymesKat/UgGeog)

# UgGeog
This is a laravel package you can use to retrieve population data for Uganda's regions, districts, subcounties and population according to the [2014 census data](http://catalog.data.ug/dataset/2014-census-data/resource/a7aff54f-a3e1-408c-94b4-cb28dde3c7dd)

# Description

This package lets you to access population statistics such as male/female population, gender ratio, land area and population density associated with regions, districts or subcounties within Uganda

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
    - [Composer](#composer)
    - [Service Provider](#service-provider)
    - [Publish Package](#publish-package)
    - [Run Migrations](#run-migrations)
- [Usage](#usage)
    - [Getting All Records](#getting-records)
    - [Getting Specific Records](#getting-specific-records)
- [Credits](#credits)
- [Contributions](#contributions)
- [License](#license)

---

## Requirements
In order to run this project, ensure that you have installed;
- PHP 5.3 or later
- Composer 

## Installation

Follow these steps to install and setup the package within your project

### Composer

Pull this package in through Composer
```
composer require jaymeskat/ug-geog
```

### Service Provider
* Laravel 5.5 +
Uses package auto discovery features to recognise the package.

* Laravel 5.4 and below
Add the package to your application service providers in `config/app.php` file.

```php
'providers' => [

    ...

    /**
     * Third Party Service Providers...
     */
    JaymesKat\UgGeog\UgGeogServiceProvider::class,

],
```

### Publish Package

Publish the package to your application if required by running this command in your terminal.

    php artisan vendor:publish --provider="JaymesKat\UgGeog\UgGeogServiceProvider"

Ensure all package classes are autoloaded
    
    composer dump-autoload


### Run Migrations

Run migrations to provision tables in your database, this will also add seed data to tables.

    php artisan migrate --seed


---

## Usage

### Getting All Records

Use models from package to get the records.

#### Regions
    
```php
    use JaymesKat\UgGeog\Models\Region;

    $regionsArray = Region::list();

```

#### Districts

```php
    use JaymesKat\UgGeog\Models\District;

    $districtsArray = District::list();

```

#### Subcounties
    
```php
    use JaymesKat\UgGeog\Models\Subcounty;

    $subcountiesArray = Subcounty::list();
```

### Getting Specific Records

Use the package models to retrieve specific region, district or subcounty information.

```php
use JaymesKat\UgGeog\Models\Region;
use JaymesKat\UgGeog\Models\District;
use JaymesKat\UgGeog\Models\Subcounty;

$region = Region::get('Central');

$district = District::get('Kampala');

$subcounty = Subcounty::get('Bihanga');

// Get all districts within a region
$districtsWithinRegion = District::inRegion('Western');

// Get all subcounties within a district
$subcountiesWithinDistrict = Subcounty::inDistrict('Jinja');

```

---
## Credits

The data used in this package was published by [Uganda Bureau Of Statistics](https://www.ubos.org) on [data.ug](http://catalog.data.ug/dataset/2014-census-data/resource/a7aff54f-a3e1-408c-94b4-cb28dde3c7dd) 

## Contributions
I welcome comments for improvements on this package. Please document this by creating an issue


## License
This package is free software distributed under the terms of the MIT license.
