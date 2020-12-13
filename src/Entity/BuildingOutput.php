<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingOutput
 *
 * @ORM\Table(name="building_output", indexes={@ORM\Index(name="building_output_building_id_fk", columns={"building_id"})})
 * @ORM\Entity
 */
class BuildingOutput
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
     * @var float
     *
     * @ORM\Column(name="output_factor", type="float", precision=10, scale=5, nullable=false, options={"default"="1"})
     */
    private $outputFactor = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="base_output", type="smallint", nullable=false, options={"default"="1","unsigned"=true})
     */
    private $baseOutput = '1';

    /**
     * @var Building
     *
     * @ORM\OneToOne(targetEntity="Building", inversedBy="buildingOutput")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOutputFactor(): ?float
    {
        return $this->outputFactor;
    }

    public function setOutputFactor(float $outputFactor): self
    {
        $this->outputFactor = $outputFactor;

        return $this;
    }

    public function getBaseOutput(): ?int
    {
        return $this->baseOutput;
    }

    public function setBaseOutput(int $baseOutput): self
    {
        $this->baseOutput = $baseOutput;

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
