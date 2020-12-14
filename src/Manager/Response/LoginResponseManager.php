<?php

namespace App\Manager\Response;

use App\Entity\PlayerToken;
use App\Model\Response\Login\LoginResponse;

class LoginResponseManager
{
    /**
     * @param PlayerToken $playerToken
     * @return LoginResponse
     */
    public function buildLoginResponse(PlayerToken $playerToken): LoginResponse
    {
        return (new LoginResponse())
            ->setExpireDate($playerToken->getExpireDate())
            ->setRefreshToken($playerToken->getRefreshToken())
            ->setAccessToken($playerToken->getAccessToken());
    }
}