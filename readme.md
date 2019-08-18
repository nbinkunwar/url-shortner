
# Url Shortner

Url shortner which converts Long url to short sharable url made with laravel and vue js.

- Generates short url
- Redirects to long url with 302 status
- Users can specify an expiry time 


## Installation

- Clone the repo
- set up env

```
composer install
npm install
```  

```php artisan link:expire``` Expires all links with expiration date-time value less than now.

To run schedule

```
php artisan schedule:run
```
Use ```crontab -e ``` to continuously run scheduled command for expiration of links.