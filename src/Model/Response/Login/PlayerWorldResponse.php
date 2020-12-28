<?php

namespace App\Model\Response\Login;

use App\Model\Response\WorldResponse;

class PlayerWorldResponse
{
    /** @var string */
    protected $username;

    /** @var WorldResponse[] */
    protected $playerWorlds;

    /** @var WorldResponse[] */
    protected $availableWorlds;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return PlayerWorldResponse
     */
    public function setUsername(string $username): PlayerWorldResponse
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
     * @return PlayerWorldResponse
     */
    public function setPlayerWorlds(array $playerWorlds): PlayerWorldResponse
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
     * @return PlayerWorldResponse
     */
    public function setAvailableWorlds(array $availableWorlds): PlayerWorldResponse
    {
        $this->availableWorlds = $availableWorlds;
        return $this;
    }
}