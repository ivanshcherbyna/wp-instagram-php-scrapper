# Wordpress Instagram Scraper plugin
This library is based on the Instagram web version. We develop it because nowadays it is hard to get an approved Instagram application. The purpose is to support every feature that the web desktop and mobile version support. 
<img src="https://github.com/ivanshcherbyna/wp-instagram-php-scrapper/blob/master/image.jpeg?raw=true" alt="wp-instagram-php-scrapper">

## Code Example for use in your template
before use you need defined path and use 
example here
```php
require_once IVD_WP_INSTAGRAM_PHP_SCRAPPER . '\vendor\autoload.php';
// If account is public you can query Instagram without auth
$instagram = new \InstagramScraper\Instagram();
```
--- exapmle for use in template page or API ---
```php
$instagram = Instagram::withCredentials('username', 'password');
$instagram->login();
$account = $instagram->getAccountById(3);
echo $account->getUsername();
```

Some methods do not require authentication: 
```php
$instagram = new Instagram();
$nonPrivateAccountMedias = $instagram->getMedias('kevin');
echo $nonPrivateAccountMedias[0]->getLink();
```

If you use authentication it is recommended to cache the user session. In this case you don't need to run the `$instagram->login()` method every time your program runs:

```php
$instagram = Instagram::withCredentials('username', 'password', '/path/to/cache/folder/');
$instagram->login(); // will use cached session if you can force login $instagram->login(true)
$account = $instagram->getAccountById(3);
echo $account->getUsername();
```

Using proxy for requests:

```php
$instagram = new Instagram();
Instagram::setProxy([
    'address' => '111.112.113.114',
    'port'    => '8080',
    'tunnel'  => true,
    'timeout' => 30,
]);
// Request with proxy
$account = $instagram->getAccount('kevin');
Instagram::disableProxy();
// Request without proxy
$account = $instagram->getAccount('kevin');
```
## Templates in directory path/templates/...

# == Installation ==


## = MANUAL INSTALLATION =
[github repository](https://github.com/ivanshcherbyna/wp-instagram-php-scrapper).

1. Copy the entire /instagram-php-scraper/ directory into your /wp-content/plugins/ directory.

2. Activate the plugin.

## = AUTOMATIC INSTALLATION =

```
Sorry -> temp. now is not exist in plugin directory
use Manual from [github repository]
```

First of all you need to install [plugin repository](https://wordpress.org/plugins/).


1. Log in to your WordPress blog and visit Plugins -> Add New.

2. Search for INSTAGRAM SCRAPPER-IVD, click "Install Now" and then Activate the Plugin



### Using composer

```sh
composer.phar require raiym/instagram-php-scraper
```
or 
```sh
composer require raiym/instagram-php-scraper
```

### If you don't have composer
You can download it [here](https://getcomposer.org/download/).

