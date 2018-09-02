<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="person_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $personId;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="mail", type="string", nullable=false)
     */
    private $mail;

    /**
     * @var OauthUsers
     * @ORM\OneToOne(targetEntity="App\Entity\OauthUsers", mappedBy="person")
     */
    private $oauthUser;

    /**
     * @return int
     */
    public function getPersonId(): int
    {
        return $this->personId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return OauthUsers
     */
    public function getOauthUser(): OauthUsers
    {
        return $this->oauthUser;
    }

    /**
     * @param OauthUsers $oauthUser
     */
    public function setOauthUser(OauthUsers $oauthUser): void
    {
        $this->oauthUser = $oauthUser;
    }
}
