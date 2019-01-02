# Movie Metadata Service

Provide movie’s external metadata, IMDB ratings, pictures, etc

- [Stack](#stack)
- [Installation](#installation)
- [Usage](#usage)

## Stack

* Symfony 4.2
* PHP 7.1

## Installation

Let's clone the repo from github using the following command:

```
$ git@github.com:mookofe/movie-metadata-service.git
```

Next step install Symfony dependencies running:

```
$ cd movie-metadata-service
$ composer install
```

Setup environment variables:

```batch
$ cp .env.dist .env
```

Run tests:

```batch
$ bin/phpunit
```

## Usage:
Run the application using the following command:

```batch
$ php -S localhost:8004 -t public
```

Finally open your browser using the url: `http://localhost:8004/api`