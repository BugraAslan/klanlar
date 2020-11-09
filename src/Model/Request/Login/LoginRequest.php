<?php

namespace App\Model\Request\Login;


use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Serializer\Type("string")
     */
    private $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return LoginRequest
     */
    public function setUsername(string $username): LoginRequest
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return LoginRequest
     */
    public function setPassword(string $password): LoginRequest
    {
        $this->password = $password;
        return $this;
    }
}