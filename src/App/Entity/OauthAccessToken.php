<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthAccessToken
 * @package App\Entity
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 * @ORM\Table(name="oauth_access_tokens")
 * @ORM\Entity
 */
class OauthAccessToken
{
    /**
     * @var string
     * @ORM\Column(name="access_token", type="string", length=40, nullable=false)
     * @ORM\Id
     */
    private $accessToken;

    /**
     * @var string
     * @ORM\Column(name="client_id", type="string", length=80, nullable=false)
     */
    private $clientId;

    /**
     * @var string
     * @ORM\Column(name="user_id", type="string", length=255, nullable=true)
     */
    private $userId;

    /**
     * @var \DateTime
     * @ORM\Column(name="expires", type="datetime", nullable=false)
     */
    private $expires;

    /**
     * @var string
     * @ORM\Column(name="scope", type="string", length=2000, nullable=true)
     */
    private $scope;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return \DateTime
     */
    public function getExpires(): \DateTime
    {
        return $this->expires;
    }

    /**
     * @param \DateTime $expires
     */
    public function setExpires(\DateTime $expires): void
    {
        $this->expires = $expires;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     */
    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }
}
