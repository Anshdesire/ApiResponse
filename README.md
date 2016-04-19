# ApiResponse
Maintained by @anshdesire, Laravel api reponse generatorin the laravel 5 application. and published to packagist(https://packagist.org/packages/swapnil/api-response-creator) .


## Installation 

You can install the package through Composer.

composer require swapnil/api-response-creator

```
You must install this service provider. Make this the very first provider in list.

```php

'providers' => [
    'Swapnil\ApiResponse\ServiceProvider',
    //...
];
```

## Use

```php

return \ApiResponse::respond($data, $status = true,$headers = []);

return \ApiResponse::setStatusCode(200);

return  \ApiResponse::setErrorCode(200); //with error code given in cofig.
 
return \ApiResponse::getStatusCode();
 
return \ApiResponse::getStatusCodeList()[404];

return \ApiResponse::respondWithPagination(Paginator $items, $data, $status= true); // if pagination data needs to be send then 
 
Method chaining can also be used here.
 
 return \ApiResponse::setStatusCode(200)->ApiResponse::respondWithPagination(Paginator $items, $data, $status= true);
 
 
 
 
 
 Standard json response structure
 
 {
  "status_code": 422,
  "errors": [
    {
      "error_message": "Validation error.",
      "error_code": 2004,
      "error_data": {
        "user_name": [
          "The user name has already been taken."
        ],
        "mobile": [
          "The mobile has already been taken."
        ]
      }
    }
  ],
  "data": [],
  "paginator": [],
  "success": false,
  "success_message": "Unprocessed entity"
}




All kind of error codes and error messages can be configured in swapnil.api-response.php config file.


    'status_code' => 200,
    'status_code_list' => [
      200 => 200,
      422 => 422,
      201 => 201,
      404 => 404,
      500 => 500,
    ],
    'status_code_messages' => [
          200 => 'Request successfully processed.',
          422 => 'Unprocessed entity',
          201 => 'Created.',
          404 => '',
          500 => 'Internal Server Error.',
    ],
    'errors_list' => [ // configurable
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
     ],
  
  
  
  

```



## License
The MIT License (MIT). Please see [LICENSE](https://github.com/Anshdesire/ApiResponse/blob/master/LICENSE.txt) for more information.

