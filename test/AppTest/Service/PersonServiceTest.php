<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Entity\Person;
use App\Service\PersonService;
use AppTest\AbstractTestCase;

/**
 * Class PersonServiceTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class PersonServiceTest extends AbstractTestCase
{

    public function testCanSavePerson()
    {
        /** @var PersonService $personSvc */
        $personSvc = $this->container->get(PersonService::class);

        $data['email'] = 'test@gmail.com';
        $data['firstName'] = 'Test';
        $data['lastName'] = 'RSimples';
        $data['photo'] = '/images/photos/test.jpg';
        $data['photoUrl'] = 'http://photo-test.com.br/test.jpg';

        $person = $personSvc->save($data);

        $this->assertInstanceOf(Person::class, $person);
    }
}
