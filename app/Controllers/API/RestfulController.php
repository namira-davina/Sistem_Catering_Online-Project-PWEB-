<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;

class RestfulController extends ResourceController
{
    /**
     * @var IncomingRequest
     */
    protected $request;

    protected $format = 'json';

    protected function responseHasil($code, $status, $data)
    {
        return $this->respond([
            'code' => $code,
            'status' => $status,
            'data' => $data,
        ]);
    }
}