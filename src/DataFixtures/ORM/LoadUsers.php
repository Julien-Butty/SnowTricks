<?php
namespace App\DataFixtures\ORM;
use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadUsers extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('juju');
        $user1->setEmail('julienbutty@gmail.com');
        $user1->setPlainPassword('snowTricks');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Baloo');
        $user2->setEmail('julienbutty+1@gmail.com');
        $user2->setPlainPassword('snowTricks');
        $manager->persist($user2);

        $manager->flush();
    }
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
    }
}