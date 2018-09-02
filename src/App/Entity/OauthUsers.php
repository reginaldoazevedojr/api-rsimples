<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthUsers
 *
 * @ORM\Table(name="oauth_users")
 * @ORM\Entity
 */
class OauthUsers extends AbstractEntity
{

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="facebook_token", type="string", nullable=true)
     */
    private $facebookToken;

    /**
     * @var string
     * @ORM\Column(name="gmail_token", type="string", nullable=true)
     */
    private $gmailToken;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Person", inversedBy="user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id", nullable=false)
     * })
     */
    private $person;

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
