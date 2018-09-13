<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\OauthAccessToken;
use App\Entity\OauthUsers;
use Doctrine\ORM\EntityRepository;

/**
 * Class OauthUsersRepository
 * @package App\Repository
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthUsersRepository extends EntityRepository
{

    /**
     * OauthUser from Token in find
     * @param string token
     * @return OauthUsers
     */
    public function findByToken($token): OauthUsers
    {
        $query = $this->createQueryBuilder('O');
        $query->select('O');
        $query->leftJoin(OauthAccessToken::class, 'A', 'WITH', 'O.username = A.userId');
        $query->where("A.accessToken = :token");
        $query->setParameter("token", $token);
        $result = $query->getQuery()->getResult();

        return $result[0] ?? null;
    }
}
