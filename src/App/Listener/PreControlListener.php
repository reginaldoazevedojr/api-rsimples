<?php

namespace App\Listener;

use App\Entity\AbstractEntity;
use App\Entity\OauthUsers;
use App\Service\UsuarioService;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PrePersist;
use OAuth2\Request;

/**
 * Class ControlEvent
 * @package App\Listener
 * @author Reginaldo Azevedo Junior <reginaldo.junior@mutua.com.br>
 */
class PreControlListener
{
    /**
     * @param EntityManager $entitym
     * @return OauthUsers
     * @throws \Doctrine\ORM\ORMException
     */
    public function findUserLogged(EntityManager $entitym)
    {
        $request = Request::createFromGlobals();

        $token = str_replace('Bearer ', '', $request->headers['AUTHORIZATION']);
        if ($token != null) {
            $repository = $entitym->getRepository(OauthUsers::class);

            /** @var OauthUsers $user */
            $user = $repository->findbyToken($token);
            return $user;
        }
        /** @var OauthUsers $oauthUser */
        $oauthUser = $entitym->getReference(OauthUsers::class, 'system');
        return $oauthUser;
    }

    /**
     * @param PreUpdateEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entitym = $args->getEntityManager();

        $entity = $args->getEntity();

        $oauthUser = $this->findUserLogged($entitym);

        $entity->setUpdatedBy($oauthUser);
        $entity->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entitym = $args->getEntityManager();

        $entity = $args->getEntity();

        $oauthUser = $this->findUserLogged($entitym);

        $entity->setCreatedBy($oauthUser);
        $entity->setCreatedAt(new \DateTime('now'));
    }
}
