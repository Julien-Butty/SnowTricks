<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 16/04/2018
 * Time: 07:41
 */

namespace App\DataFixtures\ORM;


use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImages extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $mute = new Image();
        $mute->setUrl('Mute.jpg');
        $mute->setTrick($this->getReference('Mute'));
        $manager->persist($mute);

        $mute2= new Image();
        $mute2->setUrl('Mute2.jpg');
        $mute2->setTrick($this->getReference('Mute'));
        $manager->persist($mute2);

        $melon = new Image();
        $melon->setUrl('Melon.jpg');
        $melon->setTrick($this->getReference('Melon'));
        $manager->persist($melon);

        $melon2 = new Image();
        $melon2->setUrl('Melon2.jpg');
        $melon2->setTrick($this->getReference('Melon'));
        $manager->persist($melon2);

        $indy = new Image();
        $indy->setUrl('Indy.jpg');
        $indy->setTrick($this->getReference('Indy'));
        $manager->persist($indy);

        $indy2 = new Image();
        $indy2->setUrl('Indy2.jpg');
        $indy2->setTrick($this->getReference('Indy'));
        $manager->persist($indy2);


        $f720= new Image();
        $f720->setUrl('F720.jpg');
        $f720->setTrick($this->getReference('F720'));
        $manager->persist($f720);

        $b180= new Image();
        $b180->setUrl('B180.jpg');
        $b180->setTrick($this->getReference('B180'));
        $manager->persist($b180);

        $valeflip= new Image();
        $valeflip->setUrl('Valeflip.jpg');
        $valeflip->setTrick($this->getReference('Valeflip'));
        $manager->persist($valeflip);

        $cab= new Image();
        $cab->setUrl('Cab.jpg');
        $cab->setTrick($this->getReference('Cab'));
        $manager->persist($cab);

        $ollie= new Image();
        $ollie->setUrl('Ollie.jpg');
        $ollie->setTrick($this->getReference('Ollie'));
        $manager->persist($ollie);

        $method = new Image();
        $method->setUrl('Method.jpg');
        $method->setTrick($this->getReference('method'));
        $manager->persist($method);

        $method2 = new Image();
        $method2->setUrl('Method2.jpg');
        $method2->setTrick($this->getReference('method'));
        $manager->persist($method2);




        $manager->flush();
    }

    function getDependencies()
    {
        return array(
            LoadTricks::class
        );
    }
}