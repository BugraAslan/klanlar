<?php

namespace App\Model\Response\Login;

use DateTime;

class LoginResponse
{
    /** @var string */
    public $accessToken;

    /** @var string */
    public $refreshToken;

    /** @var DateTime */
    public $expireDate;

    /**
     * @param string $accessToken
     * @return LoginResponse
     */
    public function setAccessToken(string $accessToken): LoginResponse
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @param string $refreshToken
     * @return LoginResponse
     */
    public function setRefreshToken(string $refreshToken): LoginResponse
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @param DateTime $expireDate
     * @return LoginResponse
     */
    public function setExpireDate(DateTime $expireDate): LoginResponse
    {
        $this->expireDate = $expireDate;
        return $this;
    }
}