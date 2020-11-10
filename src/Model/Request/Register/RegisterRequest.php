<?php

namespace App\Model\Request\Register;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Serializer\Type("string")
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return RegisterRequest
     */
    public function setUsername(string $username): RegisterRequest
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
     * @return RegisterRequest
     */
    public function setPassword(string $password): RegisterRequest
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return RegisterRequest
     */
    public function setEmail(string $email): RegisterRequest
    {
        $this->email = $email;
        return $this;
    }
}