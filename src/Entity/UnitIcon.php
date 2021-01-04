<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitIcon
 *
 * @ORM\Table(name="unit_icon", indexes={@ORM\Index(name="unit_icon_unit_id_fk", columns={"unit_id"})})
 *
 * @ORM\Entity
 */
class UnitIcon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Unit|null
     *
     * @ORM\OneToOne(targetEntity="Unit", inversedBy="icons")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="overview_icon", type="string", nullable=true, length=500)
     */
    private $overviewIcon;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_icon", type="string", nullable=true, length=500)
     */
    private $detailIcon;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    public function getOverviewIcon(): string
    {
        return $this->overviewIcon;
    }

    public function setOverviewIcon(string $overviewIcon): self
    {
        $this->overviewIcon = $overviewIcon;
        return $this;
    }

    public function getDetailIcon(): string
    {
        return $this->detailIcon;
    }

    public function setDetailIcon(string $detailIcon): self
    {
        $this->detailIcon = $detailIcon;
        return $this;
    }
}