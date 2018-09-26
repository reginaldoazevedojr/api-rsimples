<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FinancialPlanning
 * @package App\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\Entity
 */
class FinancialPlanning extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="financial_planning_id", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $financialPlanningId;

    /**
     * @var boolean
     * @ORM\Column(name="default", type="boolean", nullable=false)
     */
    private $default = false;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id", nullable=false)
     * })
     */
    private $person;

    /**
     * @return int
     */
    public function getFinancialPlanningId(): int
    {
        return $this->financialPlanningId;
    }

    /**
     * @param int $financialPlanningId
     */
    public function setFinancialPlanningId(int $financialPlanningId): void
    {
        $this->financialPlanningId = $financialPlanningId;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault(bool $default): void
    {
        $this->default = $default;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}
