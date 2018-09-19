<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Funcionario;
use App\Entity\OauthUsers;
use App\Entity\Perfil;
use App\Exception\NotGenerateOauthException;
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
     * @throws NotGenerateOauthException
     */
    public function getUserLogged(): OauthUsers
    {
        $request = Request::createFromGlobals();
        $authorization = $request->headers['AUTHORIZATION'];

        if (!$authorization) {
            throw new NotGenerateOauthException('Not found Authorization Header', 99);
        }

        if (stripos($authorization, 'Bearer ') === false) {
            throw new NotGenerateOauthException('Not found Bearer in authorization', 99);
        }

        $token = str_replace('Bearer ', '', $authorization);

        if ($token == null) {
            throw new NotGenerateOauthException('Out token session', 99, 'Not found token in authorization');
        }

        /** @var OauthUsersRepository $repository */
        $repository = $this->entitym->getRepository(OauthUsers::class);

        $user = $repository->findbyToken($token);

        return $user;
    }
}
