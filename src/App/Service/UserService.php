<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Funcionario;
use App\Entity\OauthUsers;
use App\Entity\Perfil;
use App\Repository\OauthUsersRepository;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;
use OAuth2\Request;

/**
 * Class UserService
 * @package App\Service
 * @author Reginaldo Azevedo junior <reginaldo.junior@mutua.com.br>
 */
class UserService
{
    /**
     * @var EntityManager
     */
    private $entitym;

    /**
     * UserService constructor.
     * @param EntityManager $entitym
     */
    public function __construct(EntityManager $entitym)
    {
        $this->entitym = $entitym;
    }

    /**
     * @return OauthUsers
     * @throws \Exception
     */
    public function getUserLogged(): OauthUsers
    {
        $request = Request::createFromGlobals();
        $token = str_replace('Bearer ', '', $request->headers['AUTHORIZATION']);
        if ($token == null) {
            throw new \Exception('Out token session');
        }
        /** @var OauthUsersRepository $repository */
        $repository = $this->entitym->getRepository(OauthUsers::class);

        $user = $repository->findbyToken($token);
        return $user;
    }
}
