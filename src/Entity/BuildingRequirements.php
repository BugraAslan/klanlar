<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingRequirements
 *
 * @ORM\Table(name="building_requirements", indexes={@ORM\Index(name="building_requirements_building_id_fk", columns={"building_id"})})
 * @ORM\Entity
 */
class BuildingRequirements
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
     * @var int
     *
     * @ORM\Column(name="required_building_id", type="integer", nullable=false)
     */
    private $requiredBuildingId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="required_level", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $requiredLevel = '0';

    /**
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     * })
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequiredBuildingId(): ?int
    {
        return $this->requiredBuildingId;
    }

    public function setRequiredBuildingId(int $requiredBuildingId): self
    {
        $this->requiredBuildingId = $requiredBuildingId;

        return $this;
    }

    public function getRequiredLevel(): ?int
    {
        return $this->requiredLevel;
    }

    public function setRequiredLevel(int $requiredLevel): self
    {
        $this->requiredLevel = $requiredLevel;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }


}
