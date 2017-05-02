# Laravel Mailgun Setup

#### Step 1
```
composer require bogardo/mailgun
```
#### Step 2
```
composer require php-http/guzzle6-adapter
```
#### Step 3
##### change below keys in .env file :
```
MAIL_DRIVER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=something@domain.com
MAIL_FROM_NAME=Project
```
#### Step 4
##### Register the ServiceProvider in config/app.php
```
Bogardo\Mailgun\MailgunServiceProvider::class
```
##### also add facade
```
'Mailgun' => Bogardo\Mailgun\Facades\Mailgun::class
```
#### Step 5
##### In your AppServiceProvider add the following in register function:
```
$this->app->bind('mailgun.client', function() {
  return \Http\Adapter\Guzzle6\Client::createWithConfig([]);
});
```
#### Step 6
##### In config/services.php update mailgun key :
	'domain' => 'domain.com',
	'secret' => 'key-*yourapikey*'
#### Step 7
##### Run the following command, it will create a file config/mailgun.php.
```
php artisan vendor:publish --provider="Bogardo\Mailgun\MailgunServiceProvider" --tag="config"
```
##### Then update domain, key and from params in config/mailgun.php


#### Example
```
$response = \Mailgun::send('emails.myview', [], function ($message) {
    $message->to('send@someone.com', 'Someones Name')->subject('My Subject!');
});
```
##### below syntax will send a mail 60 seconds later
```
$response = \Mailgun::later(60, 'emails.myview', [], function ($message) {
    $message->to('send@someone.com', 'Someones Name')->subject('My Subject!');
});
```

##### For testing mail contents or to preview a mail change config/mailgun.php
```
'api' => [
    'endpoint' => 'bin.mailgun.net',
    'version' => 'yourID',
    'ssl' => true
],
```
##### Go to bin.mailgun.net, you will get an ID

