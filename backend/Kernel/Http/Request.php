<?php

namespace Kernel\Http;

use Kernel\Http\Validator;

class Request
{
    protected $validator;
    protected $data;
    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function input()
    {
        $requestBody = file_get_contents('php://input');
        $this->data = json_decode($requestBody, true);
        return $this->data;
    }

    public function validate(array $rules)
    {
        $data = $this->input();
        return $this->validator->validate($rules, $data);
    }
}