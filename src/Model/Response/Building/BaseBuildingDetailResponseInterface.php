<?php

namespace App\Model\Response\Building;

interface BaseBuildingDetailResponseInterface
{
    public function getId(): int;

    public function setId(int $id);

    public function getName(): string;

    public function setName(string $name);

    public function getLevel(): int;

    public function setLevel(int $level);

    public function getIconUrl(): string;

    public function setIconUrl(string $iconUrl);

    public function getDescription(): string;

    public function setDescription(string $description);
}