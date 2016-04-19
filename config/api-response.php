<?php


return [
  /**
  *@desc default status code
  *
  */
  'status_code' => 200,

  /**
  *@desc array of status code list which would be used when passing status code to ApiResponse::setStatusCode
  *
  */
  'status_code_list' => [
      200 => 200,
      422 => 422,
      201 => 201,
      404 => 404,
      500 => 500,
  ],
  /**
  *@desc array of status code Messages to be shown in response data
  *
  */
  'status_code_messages' => [
      200 => 'Request successfully processed.',
      422 => 'Unprocessed entity',
      201 => 'Created.',
      404 => '',
      500 => 'Internal Server Error.',
  ],


  /**
  *@desc array of error codes which will contain detailed information of error 
  *
  */
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
];
