<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 17/04/2018
 * Time: 09:57
 */

namespace App\DataFixtures\ORM;


use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVideos extends Fixture implements DependentFixtureInterface
{
    function getDependencies()
    {
        return array(
            LoadTricks::class
        );
    }

    public function load(ObjectManager $manager)
    {
        $mute = new  Video();
        $mute->setType('youtube');
        $mute->setIdentif('M5NTCfdObfs');
        $mute->setTrick($this->getReference('Mute'));
        $manager->persist($mute);

        $melon = new Video();
        $melon->setType('youtube');
        $melon->setIdentif('4h4cB1Kkc2s');
        $melon->setTrick($this->getReference('Melon'));
        $manager->persist($melon);

        $f720 = new Video();
        $f720->setType('youtube');
        $f720->setIdentif('XkkUSEz3I00');
        $f720->setTrick($this->getReference('F720'));
        $manager->persist($f720);



        $manager->flush();

    }


}