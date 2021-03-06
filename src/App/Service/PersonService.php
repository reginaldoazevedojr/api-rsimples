<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Person;
use App\Exception\NotSaveException;
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
     * @throws NotSaveException
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
        if ($data['photo']) {
            $person->setPhoto($data['photo']);
        }
        if ($data['photoUrl']) {
            $person->setPhotoUrl($data['photoUrl']);
        }

        try {
            $this->entitym->persist($person);
            $this->entitym->flush();
            return $person;
        } catch (\Exception $error) {
            throw new NotSaveException($error->getMessage(), $error->getCode(), $error->getMessage());
        }
    }


}
