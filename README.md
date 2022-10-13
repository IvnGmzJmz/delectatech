# Symfony4 App #
------------------

## Setup Project ##

**0. Install Vendors:** 

```bash
composer install
yarn install
```


**1. Create Schema:** Mandatory if you clone new project, or you are developing with a new database:

```bash
 php bin/console doctrine:schema:create
```

**2. Check database integrity:** Mandatory if you pull code or if you are changing mappings or database: 

```bash
 php bin/console doctrine:schema:validate
```

**3. Import initial data:** In order to generate the initial data this command should be executed:

```bash
php bin/console symfony:import-data /var/www/exam_input.json # this path corresponds to docker container path 

```

**4. Compile SCSS & JS with Yarn:** The first execution and everytime that you want to change anything in the **assets** folder (styles or JS) you must recompile all the code using: 

```bash
 yarn run dev
```


**5. If any entity is modified** Run: 

```bash
php bin/console make:entity --regenerate Domain
``` 

## Configuration Notes ##

- Environment specific variables (db connections, etc.) are placed in ```/.env```

- Doctrine mappings must be placed in ```config/doctrine/```

- WebPack assets configuration is placed in ```webpack.config.js``` 

- Tested on:
    * PHP 7.3.33
    * Composer 1.9.3
    * Yarn 1.22.19
    * Node 8.10.0 
    * MariaDB 10.4.12