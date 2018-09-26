<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Income
 * @package App\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\Entity
 */
class Income extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="income_id", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $incomeId;

    /**
     * @var float
     * @ORM\Column(name="value", type="float", nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_pay", type="date", nullable=true)
     */
    private $datePay;

    /**
     * @var int
     * @ORM\Column(name="quota", type="integer", nullable=false)
     */
    private $quota = 1;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @var FinancialPlanning
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\FinancialPlanning")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="financial_planning_id", referencedColumnName="financial_planning_id", nullable=false)
     * })
     */
    private $financialPlanning;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Label")
     *  @ORM\JoinTable(name="income_label",
     *      joinColumns={@ORM\JoinColumn(name="income_id", referencedColumnName="income_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="label_id", referencedColumnName="label_id")}
     *  )
     */
    private $labels;

    /**
     * Income constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->labels = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIncomeId(): int
    {
        return $this->incomeId;
    }

    /**
     * @param int $incomeId
     */
    public function setIncomeId(int $incomeId): void
    {
        $this->incomeId = $incomeId;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return \DateTime
     */
    public function getDatePay(): ?\DateTime
    {
        return $this->datePay;
    }

    /**
     * @param \DateTime $datePay
     */
    public function setDatePay(\DateTime $datePay): void
    {
        $this->datePay = $datePay;
    }

    /**
     * @return int
     */
    public function getQuota(): int
    {
        return $this->quota;
    }

    /**
     * @param int $quota
     */
    public function setQuota(int $quota): void
    {
        $this->quota = $quota;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return FinancialPlanning
     */
    public function getFinancialPlanning(): FinancialPlanning
    {
        return $this->financialPlanning;
    }

    /**
     * @param FinancialPlanning $financialPlanning
     */
    public function setFinancialPlanning(FinancialPlanning $financialPlanning): void
    {
        $this->financialPlanning = $financialPlanning;
    }

    /**
     * @return ArrayCollection
     */
    public function getLabels(): ArrayCollection
    {
        return $this->labels;
    }

    /**
     * @param Label $label
     */
    public function addLabel(Label $label)
    {
        if ($this->labels->contains($label)) {
            return;
        }
        $this->labels->add($label);
    }

    /**
     * @param Label $label
     */
    public function removeLabel(Label $label)
    {
        if (!$this->labels->contains($label)) {
            return;
        }
        $this->labels->removeElement($label);
    }
}
