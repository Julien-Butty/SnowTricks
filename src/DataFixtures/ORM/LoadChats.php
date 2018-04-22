<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 23/02/2018
 * Time: 10:11
 */

namespace App\DataFixtures\ORM;


use App\Entity\Chat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadChats extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $chat1 = new Chat();

        $chat1->setMessage('Hello!');
        $chat1->setUser($this->getReference('user1'));
        $chat1->setTrick($this->getReference('Mute'));
        $manager->persist($chat1);

        $chat2 = new Chat();
        $chat2->setMessage('Salut');
        $chat2->setUser($this->getReference('user2'));
        $chat2->setTrick($this->getReference('Mute'));
        $manager->persist($chat2);

        $chat3 = new Chat();
        $chat3->setMessage(" J'aurais besoin d'un conseil pour cette figure. Tu peux m'aider ?");
        $chat3->setUser($this->getReference('user1'));
        $chat3->setTrick($this->getReference('Mute'));
        $manager->persist($chat3);


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