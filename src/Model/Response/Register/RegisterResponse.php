<?php

namespace App\Model\Response\Register;

class RegisterResponse
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $activationCode;

    /**
     * @param int $id
     * @return RegisterResponse
     */
    public function setId(int $id): RegisterResponse
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $username
     * @return RegisterResponse
     */
    public function setUsername(string $username): RegisterResponse
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $activationCode
     * @return RegisterResponse
     */
    public function setActivationCode(string $activationCode): RegisterResponse
    {
        $this->activationCode = $activationCode;
        return $this;
    }
}