<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// TODO reportType foreign key

/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity
 */
class Report
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
     * @ORM\Column(name="report_type_id", type="integer", nullable=false)
     */
    private $reportTypeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReportTypeId(): ?int
    {
        return $this->reportTypeId;
    }

    public function setReportTypeId(int $reportTypeId): self
    {
        $this->reportTypeId = $reportTypeId;

        return $this;
    }
}
