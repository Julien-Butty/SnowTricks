<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 15/04/2018
 * Time: 14:57
 */

namespace App\Tests\Controller\Admin;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickAdminControllerTest extends WebTestCase
{
    public function testNewAction()
    {
        $client = static::createClient();

        $client->request('GET', '/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}