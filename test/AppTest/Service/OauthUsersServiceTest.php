<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Entity\OauthUsers;
use App\Service\OauthUsersService;
use App\Service\PersonService;
use AppTest\AbstractTestCase;

/**
 * Class OauthUsersServiceTest
 * @package AppTest\Service
 * @author Reginaldo Azevedo Junior <reginaldoazevedojr@gmail.com>
 */
class OauthUsersServiceTest extends AbstractTestCase
{

    public function testCanSaveOauthUsers()
    {
        /** @var OauthUsersService $oauthSvc */
        $oauthSvc = $this->container->get(OauthUsersService::class);
        /** @var PersonService $personSvc */
        $personSvc = $this->container->get(PersonService::class);

        $data['email'] = 'test@rsimples.com.br';
        $data['firstName'] = 'Test';
        $data['lastName'] = 'RSimples';
        $data['photo'] = '/images/photos/test.jpg';
        $data['photoUrl'] = 'http://photo-test.com.br/test.jpg';

        $person = $personSvc->save($data);

        $data['username'] = 'test@rsimples.com.br';
        $data['facebookId'] = '000000000000000';
        $data['googleId'] = '';
        $data['password'] = '';
        $data['person'] = $person;

        $oauthUsers = $oauthSvc->save($data);
        $this->assertInstanceOf(OauthUsers::class, $oauthUsers);

        return $oauthUsers;
    }

    /**
     * @depends testCanSaveOauthUsers
     * @param OauthUsers $oauthUsers
     * @throws \Exception
     */
    public function testCanUpdateSocialId(OauthUsers $oauthUsers)
    {
        /** @var OauthUsersService $oauthSvc */
        $oauthSvc = $this->container->get(OauthUsersService::class);

        $oauthUsersUpdate = $oauthSvc->updateIdSocial($oauthUsers->getUsername(), '1111111111111111');

        $this->assertInstanceOf(OauthUsers::class, $oauthUsersUpdate);
    }


}
