<?php

namespace App\Model\Response;

class BaseResponseModel
{
    /** @var boolean */
    protected $success;

    /** @var object|array|null */
    protected $data;

    /** @var array|string|null */
    protected $errors;

    /** @var int */
    protected $statusCode;

    /**
     * BaseResponseModel constructor.
     * @param bool $success
     * @param array|object|null $data
     * @param array|string|null $errors
     * @param int $statusCode
     */
    public function __construct(bool $success, $data, $errors, int $statusCode)
    {
        $this->success = $success;
        $this->data = $data;
        $this->errors = $errors;
        $this->statusCode = $statusCode;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return BaseResponseModel
     */
    public function setSuccess(bool $success): BaseResponseModel
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return array|object|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array|object|null $data
     * @return BaseResponseModel
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array|string|null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array|string|null $errors
     * @return BaseResponseModel
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return BaseResponseModel
     */
    public function setStatusCode(int $statusCode): BaseResponseModel
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}