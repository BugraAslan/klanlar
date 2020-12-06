<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VillageResource
 *
 * @ORM\Table(name="village_resource", indexes={@ORM\Index(name="village_resource_village_id_fk", columns={"village_id"})})
 *
 * @ORM\Entity
 */
class VillageResource
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var PlayerVillage
     *
     * @ORM\OneToOne(targetEntity="PlayerVillage", inversedBy="resource")
     * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     */
    private $village;

    /**
     * @var int
     *
     * @ORM\Column(name="wood", type="integer", nullable=false)
     */
    private $wood;

    /**
     * @var int
     *
     * @ORM\Column(name="clay", type="integer", nullable=false)
     */
    private $clay;

    /**
     * @var int
     *
     * @ORM\Column(name="iron", type="integer", nullable=false)
     */
    private $iron;

    /**
     * @var int
     *
     * @ORM\Column(name="warehouse", type="smallint", options={"unsigned"=true})
     */
    private $warehouse;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="smallint", options={"unsigned"=true})
     */
    private $population;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return PlayerVillage
     */
    public function getVillage(): PlayerVillage
    {
        return $this->village;
    }

    /**
     * @param PlayerVillage $village
     * @return VillageResource
     */
    public function setVillage(PlayerVillage $village): VillageResource
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return int
     */
    public function getWood(): int
    {
        return $this->wood;
    }

    /**
     * @param int $wood
     * @return VillageResource
     */
    public function setWood(int $wood): VillageResource
    {
        $this->wood = $wood;
        return $this;
    }

    /**
     * @return int
     */
    public function getClay(): int
    {
        return $this->clay;
    }

    /**
     * @param int $clay
     * @return VillageResource
     */
    public function setClay(int $clay): VillageResource
    {
        $this->clay = $clay;
        return $this;
    }

    /**
     * @return int
     */
    public function getIron(): int
    {
        return $this->iron;
    }

    /**
     * @param int $iron
     * @return VillageResource
     */
    public function setIron(int $iron): VillageResource
    {
        $this->iron = $iron;
        return $this;
    }

    /**
     * @return int
     */
    public function getWarehouse(): int
    {
        return $this->warehouse;
    }

    /**
     * @param int $warehouse
     * @return VillageResource
     */
    public function setWarehouse(int $warehouse): VillageResource
    {
        $this->warehouse = $warehouse;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @param int $population
     * @return VillageResource
     */
    public function setPopulation(int $population): VillageResource
    {
        $this->population = $population;
        return $this;
    }
}