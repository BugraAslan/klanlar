<?php

namespace App\Model\Request\Register;

use App\Validator\Constraints\UniqueUsername;
use App\Validator\Constraints\UniqueEmail;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest
{
    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Assert\NotBlank(message="Kullanıcı adı boş bırakılamaz")
     * @Assert\Length(
     *     min="5", minMessage="Kullanıcı adı en az 5 karakterden oluşmalıdır",
     *     max="20", maxMessage="Kullanıcı adı en çok 20 karakterden oluşmalıdır"
     * )
     * @UniqueUsername()
     *
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Şifre boş bırakılamaz")
     * @Assert\Type("string")
     * @Assert\Length(
     *     min="5", minMessage="Şifre en az 5 karakterden oluşmalıdır",
     *     max="20", maxMessage="Şifre en çok 20 karakterden oluşmalıdır"
     * )
     *
     * @Serializer\Type("string")
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Assert\NotBlank(message="Email boş bırakılamaz")
     * @Assert\Email(message="Geçersiz email formatı")
     * @UniqueEmail()
     *
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