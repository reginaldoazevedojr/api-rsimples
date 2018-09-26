<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CreditCard
 * @package App\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\Entity
 */
class CreditCard extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="credit_card_id", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $creditCardId;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_pay", type="date", nullable=true)
     */
    private $datePay;

    /**
     * @return int
     */
    public function getCreditCardId(): int
    {
        return $this->creditCardId;
    }

    /**
     * @param int $creditCardId
     */
    public function setCreditCardId(int $creditCardId): void
    {
        $this->creditCardId = $creditCardId;
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
}
