# ApiResponse
Maintained by @anshdesire, Laravel api reponse generatorin the laravel 5 application.

## Installation 

You can install the package through Composer.

composer require swapnil/api-response-creator

```
You must install this service provider. Make this the very first provider in list.

```php

'providers' => [
    'Swapnil\ApiResponse\ServiceProvider',,
    //...
];
```

## Use

```php

\ApiResponse::respond()
\ApiResponse::setErrorCode() with error code given in cofig.
	    '2001' => [
    		'error_message' => 'User not found or wrong credentials.',
    		'error_code' => 2001,
            'error_data' => '',
    	],

    	'2002' => [
    		'error_message' => '2002',
    		'error_code' => 2002,
            'error_data' => '',
    	],

        '2003' => [
            'error_message' => 'Unable to create.',
            'error_code' => 2003,
            'error_data' => '',
        ],

        '2004' => [
            'error_message' => 'Validation error.',
            'error_code' => 2004,
            'error_data' => '',
        ]
        
        
  \ApiResponse::setStatusCode();
  \ApiResponse::getStatusCode();
  \ApiResponse::getStatusCodeList();
  
        
        
```

