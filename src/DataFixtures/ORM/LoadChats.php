<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 23/02/2018
 * Time: 10:11
 */

namespace App\DataFixtures\ORM;


use App\Entity\Chat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadChats extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $chat1 = new Chat();
        $chat1->setUser($this->getReference('user1'));
        $chat1->setTricks($this->getReference('mute'));
        $chat1->setMessage('Hello!');
        $chat1->setDate(new DateTime());
        $manager->persist($chat1);

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            LoadUsers::class,
            LoadTricks::class
        );
    }
}