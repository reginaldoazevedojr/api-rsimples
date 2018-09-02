<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $userId;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", nullable=false)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;



    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Person", inversedBy="user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     * })
     */
    private $person;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFacebookToken(): string
    {
        return $this->facebookToken;
    }

    /**
     * @param string $facebookToken
     */
    public function setFacebookToken(string $facebookToken): void
    {
        $this->facebookToken = $facebookToken;
    }

    /**
     * @return string
     */
    public function getGmailToken(): string
    {
        return $this->gmailToken;
    }

    /**
     * @param string $gmailToken
     */
    public function setGmailToken(string $gmailToken): void
    {
        $this->gmailToken = $gmailToken;
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