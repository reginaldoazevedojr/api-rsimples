<?php

namespace App\Entity;

use Zend\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 * @package Application\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="update_by", type="string", nullable=true)
     */
    private $updateBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($data) {
            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $this);
        }
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdateBy(): ?string
    {
        return $this->updateBy;
    }

    /**
     * @param string $updateBy
     */
    public function setUpdateBy(string $updateBy): void
    {
        $this->updateBy = $updateBy;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt(): ?\DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt(\DateTime $updateAt): void
    {
        $this->updateAt = $updateAt;
    }
}