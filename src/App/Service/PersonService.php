<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Person;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;

/**
 * Class PersonService
 * @package App\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class PersonService
{
    /**
     * @var EntityManager
     */
    private $entitym;

    /**
     * PersonService constructor.
     * @param EntityManager $entitym
     */
    public function __construct(EntityManager $entitym)
    {
        $this->entitym = $entitym;
    }

    /**
     * @param array $data
     * @return Person
     * @throws \Exception
     */
    public function save(array $data): Person
    {
        $repository = $this->entitym->getRepository(Person::class);

        /** @var Person $personVerify */
        $personVerify = $repository->findOneBy(['email' => $data['email']]);

        if ($personVerify) {
            return $personVerify;
        }

        $person = new Person();

        $person->setFirstName($data['firstName']);
        $person->setLastName($data['lastName']);
        $person->setEmail($data['email']);
        $person->setPhoto($data['photo'] ?? '');
        $person->setPhotoUrl($data['photoUrl'] ?? '');

        try {
            $this->entitym->persist($person);
            $this->entitym->flush();
            return $person;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }
    }


}
