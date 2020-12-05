<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingDescription
 *
 * @ORM\Table(name="building_description", indexes={@ORM\Index(name="building_description_building_id_fk", columns={"building_id"})})
 * @ORM\Entity
 */
class BuildingDescription
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
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var Building
     *
     * @ORM\OneToOne(targetEntity="Building", inversedBy="buildingDescription")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
