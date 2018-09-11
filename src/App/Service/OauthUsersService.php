<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\OauthUsers;
use App\Exception\NotSaveException;
use Doctrine\ORM\EntityManager;

/**
 * Class OauthUsersService
 * @package App\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthUsersService
{
    /**
     * @var EntityManager
     */
    private $entitym;

    /**
     * OauthUsersService constructor.
     * @param EntityManager $entitym
     */
    public function __construct(EntityManager $entitym)
    {
        $this->entitym = $entitym;
    }

    /**
     * @param array $data
     * @return OauthUsers
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(array $data)
    {
        $repository = $this->entitym->getRepository(OauthUsers::class);

        /** @var OauthUsers $oauthUserVerify */
        $oauthUserVerify = $repository->findOneBy(['username' => $data['username']]);

        if ($oauthUserVerify) {
            return $oauthUserVerify;
        }

        $oauthUsers = new OauthUsers();

        $oauthUsers->setUsername($data['username']);
        $oauthUsers->setPassword($data['password'] ?? '');
        $oauthUsers->setPerson($data['person']);
        $oauthUsers->setFacebookId($data['facebookId'] ?? '');
        $oauthUsers->setGoogleId($data['googleId'] ?? '');

        try {
            $this->entitym->persist($oauthUsers);
            $this->entitym->flush();
            return $oauthUsers;
        } catch (\RuntimeException $error) {
            throw new NotSaveException($error->getMessage(), $error->getCode());
        }
    }
}