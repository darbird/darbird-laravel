# laravel-darbird

A package built to allow laravel developers easily send sms from their application. 
## Requirements
[PHP](https://php.net) 5.4+, [Composer](https://getcomposer.org) are required.

## Installation
You need to be have an Darbird account to use this package. If you do not have one, [click here](https://console.darbird.com).

Require the package with composer.
``` bash
$ composer require darbird/darbirdsms
```
You might need to add `Darbird\Darbirdsms\DarbirdServiceProvider,` to the providers array `config/app.php` if your laravel version is less than 5.5.

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

## Configuration
Publish the configuration file by using this command
`php artisan vendor:publish --provider="Darbird\Darbirdsms\DarbirdServiceProvider"`

You will get a config file named `darbird.php` in your config directory. Customize the defaults to your darbird settings.
```php
    <?php 
    
    return [
    
        /**
         * Your customerID on Darbird (check the left panel of your dashboard)
         */
        'cusID'          => getenv('DARBIRD_CUS_ID'),
    
        /**
         * Your Darbird Api Key
         */
        'apiKey'            => getenv('DARBIRD_API_KEY'),
    
        /**
         * Your chosen sender name
         */
        'sender'            => getenv('DARBIRD_SENDER_ID'),
    ];
```


## Usage
Add the following to your .env file

```dotenv
DARBIRD_CUS_ID=***********
DARBIRD_API_KEY=************
DARBIRD_SENDER_ID=********
```
Create a route endpoint

```php
    Route::get('/sms', 'HomeController@index');
```
For a text message
Note: A phone number in full international format includes a plus sign (+) followed by the country code, city code, and local phone number. 
```php
    <?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Darbird\Darbirdsms\DarbirdSMS;
    
    class HomeController extends Controller
    {
        public function index()
        {
            $DB       = new DarbirdSMS();
            $sms      = $DB->sms();
            $result   = $sms->send([
                'to'      => '0701********',
                'sms' => 'Welcome t!'
            ]);
            $file =  \json_encode($result);
        }
    }
```
For a voice message
```php
    <?php
        
        namespace App\Http\Controllers;
        
        use Illuminate\Http\Request;
        use Darbird\Darbirdsms\DarbirdSMS;
        
        class HomeController extends Controller
        {
            public function index()
            {
                $DB       = new DarbirdSMS();
                $voice      = $DB->voice();
                $result   = $sms->send([
                    'to'      => '0701********',
                    'sms' => 'Welcome t!'
                ]);
                $file =  \json_encode($result);
            }
        }
```
For mms message
```php
    <?php
            
            namespace App\Http\Controllers;
            
            use Illuminate\Http\Request;
            use Darbird\Darbirdsms\DarbirdSMS;
            
            class HomeController extends Controller
            {
                public function index()
                {
                    $DB       = new DarbirdSMS();
                    $mms      = $DB->voice();
                    $result   = $mms->send([
                        'to'      => '+2340810********',
                        'sms' => 'Hello World!',
                        'media_url' => 'https://media.svg.com/welcome'
                    ]);
                    $file =  \json_encode($result);
                }
            }
```
For Schedule message
```php
    <?php
            
            namespace App\Http\Controllers;
            
            use Illuminate\Http\Request;
            use Darbird\Darbirdsms\DarbirdSMS;
            
            class HomeController extends Controller
            {
                public function index()
                {
                    $DB       = new DarbirdSMS();
                    $sc      = $DB->schedulesms();
                    $result   = $sc->send([
                        'to'      => '+2340810********',
                        'sms' => 'Hello World!',
                        'schedule' => '09/17/2018 10:20 AM'
                    ]);
                    $file =  \json_encode($result);
                }
            }
```
For Authentication message 
Note: change msg_type to voice for voice authentication 
```php
    <?php
            
            namespace App\Http\Controllers;
            
            use Illuminate\Http\Request;
            use Darbird\Darbirdsms\DarbirdSMS;
            
            class HomeController extends Controller
            {
                public function index()
                {
                    $DB       = new DarbirdSMS();
                    $auth      = $DB->authty();
                    $result   = $auth->send([
                        'to_number'      => '+2340810********',
                        'token_lenght' => '4',
                        'msg_type' => 'plain'
                    ]);
                    $file =  \json_encode($result);
                }
            }
```
For Authentication Verification 

```php
    <?php
            
            namespace App\Http\Controllers;
            
            use Illuminate\Http\Request;
            use Darbird\Darbirdsms\DarbirdSMS;
            
            class HomeController extends Controller
            {
                public function index()
                {
                    $DB       = new DarbirdSMS();
                    $auth      = $DB->authtyverify();
                    $result   = $voices->send([
                        'to_number'      => '+2340810********',
                        'auth_code' => '4083',
                     ]);
                     $file =  \json_encode($result);
                }
            }
```
## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.