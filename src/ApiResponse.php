<?php

namespace Swapnil\ApiResponse;

use paginator;

class ApiResponse
{

    private $config = [];

    protected $statusCode;// = 200;

    public $STATUS_CODE;

    public $statusCodeMessages;

    public $errorCode = [];

    public $prepareContent = [
        'status_code' => 200,
        'errors' => [],
        'data' => [],
        'paginator' => [],
        'success' => true,
        'success_message' => ''

    ];

    /**
     * error list.
     */
    protected $errorsList;

    /**
     * constructor
     *
     */
    public function __construct()
    {
        $this->statusCode = config('swapnil.api-response.status_code');

        if(empty($this->statusCode)){
            $this->statusCode = 200;
        }

        $this->STATUS_CODE = config('swapnil.api-response.status_code_list');

        if(empty($this->STATUS_CODE)){
            $this->statusCode = [
                200 => 200,
                422 => 422,
                201 => 201,
                404 => 404,
                500 => 500,
            ];
        }

        $this->statusCodeMessages = config('swapnil.api-response.status_code_messages');

        if(empty($this->statusCodeMessages)){
            $this->statusCodeMessages = [
                200 => 'Request successfully processed.',
                422 => 'Unprocessed entity',
                201 => 'Created.',
                404 => '',
                500 => config('swapnil.api-response.internal_server_error'),
            ];
        }

        $this->errorsList = config('swapnil.api-response.errors_list');
        if(empty($this->errorsList)){
            $this->errorsList = [
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

            ];
        }

    }


    /**
    * @return mixed
    */
    public function getStatusCodeList()
    {
        return $this->STATUS_CODE;
    }


    /**
    * @return mixed
    */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
    * @param mixed $statusCode
    */
    public function setErrorCode($errorCode = [])
    {
        $this->errorCode = !empty($this->errorCode) ? array_merge($this->errorCode,$errorCode) : $errorCode;

        return $this;
    }




    /**
    * @return mixed
    */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
    * @param mixed $statusCode
    */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * response not found error
     * @return object
     */
    public function respondNotFound($message = config('swapnil.api-response.resource_not_found'))
    {
        return $this->setStatusCode($this->STATUS_CODE[404])->respondWithError($message);
    }

    /**
     * respond internal error
     * @return object
     */
    public function respondInternalError($message = config('swapnil.api-response.internal_server_error'))
    {
        return $this->setStatusCode($this->STATUS_CODE[500])->respond([],$message,[]);
    }

    /**
     * respond
     * @return object
     */
    public function respond($data, $status = true,$headers = [])
    {
        if($this->statusCode != $this->STATUS_CODE[422]){
            $this->prepareContent['data'] = $data;
        }

        $this->assignErrorData($data);
        $this->prepareContent['success'] = $status;
        $this->prepareContent['status_code'] = $this->statusCode;

        $this->prepareContent['success_message'] = $this->statusCodeMessages[$this->statusCode];
        $dataError = [];
        if(is_array($this->errorCode)){
            foreach ($this->errorCode as $key => $value) {
                $dataError[] = $this->errorsList[$value];
            }
        }else{
            $dataError[] = $this->errorsList[$this->errorCode];
        }

        $this->prepareContent['errors'] = $dataError;

        return response()->json($this->prepareContent, $this->STATUS_CODE[200], $headers);
    }

    /**
     * error data parsing
     * @return object
     */
    public function assignErrorData($data)
    {
        if($this->statusCode == $this->STATUS_CODE[422]) {
            $this->errorsList['2004']['error_data'] = $data;
        }
        return $this;
    }

    /**
     * set pagination data
     * @return object
     */
    public function respondWithPagination(Paginator $items, $data, $status= true)
    {
        $this->prepareContent['paginator'] = [
            "total_count" => $items->total(),
            "total_pages" => ceil($items->total() / $items->perPage()),
            "current_page" => $items->currentPage(),
            "limit" => $items->perPage()
        ];

        return $this->respond($this->prepareContent, $status);
    }
}
