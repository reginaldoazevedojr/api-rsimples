<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthClients
 *
 * @ORM\Table(name="oauth_clients")
 * @ORM\Entity
 */
class OauthClients
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=80, nullable=false)
     * @ORM\Id
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_secret", type="string", length=80, nullable=true)
     */
    private $clientSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_uri", type="string", length=2000, nullable=false)
     */
    private $redirectUri;

    /**
     * @var string
     *
     * @ORM\Column(name="grant_types", type="string", length=80, nullable=true)
     */
    private $grantTypes;

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=100, nullable=true)
     */
    private $scope;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=80, nullable=true)
     */
    private $userId;

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
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri(string $redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return string
     */
    public function getGrantTypes(): string
    {
        return $this->grantTypes;
    }

    /**
     * @param string $grantTypes
     */
    public function setGrantTypes(string $grantTypes)
    {
        $this->grantTypes = $grantTypes;
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
    public function setScope(string $scope)
    {
        $this->scope = $scope;
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
    public function setUserId(string $userId)
    {
        $this->userId = $userId;
    }
}
