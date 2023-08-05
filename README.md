## Blog challenge - API

## Implemented endpoints
* [x] Show posts paginated, and ordered by creation date with their information (id, slug, title, excerpt, user).
* [x] A user can login.
* [x] An authenticated user can create a new post
* [x] An authenticated user can update his post
* [x] An authenticated user can remove his posts
* [x] An authenticated user can see details of a specific post.

## Unit/Feature testing
![](.doc/tests.png)

## Used technologies

- PHP 8.1
- Laravel 9
- PHPUnit
- Redis (for queue)
- Sanctum (for authentication)
- Docker
- IDE: PHPStorm

## Installation Steps

> prerequisite: PHP >= 8.1

* Clone repository
* `composer install`
* Create DB eg: `blog_challenge_api`
* `composer setup` (copies `env` file, generates key, and migrates DB)
* Then run ``` php artisan serve ```

## Testing
In this file [doc/postman_collection.json](.doc/postman_collection.json) you will find the postman collection which you can import into your local postman app and test the api.






