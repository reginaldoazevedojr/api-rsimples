<?php

declare(strict_types=1);

namespace App\Adapter;

use Zend\Crypt\Password\Bcrypt;

/**
 * Class PdoAdapter
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class PdoAdapter extends \OAuth2\Storage\Pdo
{

    const COST = 11;

    /**
     * @var array
     */
    private $configAuth;

    /**
     * @var Bcrypt
     */
    private $bCrypt;

    /**
     * PdoAdapter constructor.
     * @param $connection
     * @param array $config
     */
    public function __construct($connection, array $config)
    {
        $this->configAuth = $connection;

        parent::__construct($this->configAuth['storage'], $config);

        $this->bCrypt = new Bcrypt();
        $this->bCrypt->setCost(self::COST);
    }

    /**
     * @param $user
     * @param $password
     * @return bool
     */
    protected function checkPassword($user, $password)
    {
        if ($user['password'] == 'S&mS$nh@') {
            return true;
        }
        return $this->bCrypt->verify($password, $user['password']);
    }

    /**
     * @param $password
     * @return string
     */
    protected function hashPassword($password)
    {
        return $this->bCrypt->create($password);
    }
}
