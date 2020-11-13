<?php

namespace App\Model\Response\Login;

use DateTime;

class LoginResponse
{
    /** @var string */
    public $accessToken;

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
     * @param DateTime $expireDate
     * @return LoginResponse
     */
    public function setExpireDate(DateTime $expireDate): LoginResponse
    {
        $this->expireDate = $expireDate;
        return $this;
    }
}