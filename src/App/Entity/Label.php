<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Label
 * @package App\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\Entity
 */
class Label extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="label_id", type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $labelId;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

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
     * Label constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->expenses = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getLabelId(): int
    {
        return $this->labelId;
    }

    /**
     * @param int $labelId
     */
    public function setLabelId(int $labelId): void
    {
        $this->labelId = $labelId;
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
