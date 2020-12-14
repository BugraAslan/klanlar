<?php

namespace App\Model\Response\Login;

use App\Model\Response\WorldResponse;

class WorldLoginResponse
{
    /** @var string */
    protected $username;

    /** @var WorldResponse[] */
    protected $playerWorlds = [];

    /** @var WorldResponse[] */
    protected $availableWorlds = [];

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return WorldLoginResponse
     */
    public function setUsername(string $username): WorldLoginResponse
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return WorldResponse[]
     */
    public function getPlayerWorlds(): array
    {
        return $this->playerWorlds;
    }

    /**
     * @param WorldResponse[] $playerWorlds
     * @return WorldLoginResponse
     */
    public function setPlayerWorlds(array $playerWorlds): WorldLoginResponse
    {
        $this->playerWorlds = $playerWorlds;
        return $this;
    }

    /**
     * @return WorldResponse[]
     */
    public function getAvailableWorlds(): array
    {
        return $this->availableWorlds;
    }

    /**
     * @param WorldResponse[] $availableWorlds
     * @return WorldLoginResponse
     */
    public function setAvailableWorlds(array $availableWorlds): WorldLoginResponse
    {
        $this->availableWorlds = $availableWorlds;
        return $this;
    }
}