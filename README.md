# Falcon Auth Project

This project demonstrates an authentication (auth) framework developed on Phalcon 5.8 and PHP 8.3. The project provides a basic framework for managing authentication processes. This build is not a package, but is intended as an auth mechanism that can be used in Phalcon projects.

## Features

- User login and logout processes.
- Encrypted password storage (with bcrypt).
- Simple and understandable code structure.


## Requirements

- **PHP**: 8.3 or higher
- **Phalcon**: 5.8 or higher
- **Composer**: For dependency management
- **Database**: MySQL or another SQL compatible database

## Installation

1. **Clone Project**

bash
git clone https://github.com/KamilTahirli/phalcon-auth-system.git
cd phalcon-auth


2. **Install Dependencies**

bash
composer install


3. **Configure Database**

Add the database connection settings to the config/config.php file.

Example:

php


return

[

 'database' => [
 
 'adapter' => 'Mysql',
 
 'host' => '127.0.0.1',
 
 'username' => 'root',
 
 'password' => 'password',
 
 'dbname' => 'phalcon_auth',

 ],

];
