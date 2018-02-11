<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 11/02/2018
 * Time: 09:21
 */

namespace App\DataFixtures\ORM;


use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
     $user1 = new User();
     $user1->setUsername('juju');
     $user1->setEmail('julienbutty@gmail.com');

     $user2 = new User();
     $user2->setUsername('Baloo');
     $user2->setEmail('julienbutty+1@gmail.com');
    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
    }
}