<?php

declare(strict_types=1);

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
     * @var OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="username", nullable=false)
     * })
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="username", nullable=true)
     * })
     */
    private $updatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

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
     * @return OauthUsers
     */
    public function getCreatedBy(): OauthUsers
    {
        return $this->createdBy;
    }

    /**
     * @param OauthUsers $createdBy
     */
    public function setCreatedBy(OauthUsers $createdBy): void
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
     * @return OauthUsers
     */
    public function getUpdatedBy(): ?OauthUsers
    {
        return $this->updatedBy;
    }

    /**
     * @param OauthUsers $updatedBy
     */
    public function setUpdatedBy(OauthUsers $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}