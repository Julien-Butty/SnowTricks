<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 11/02/2018
 * Time: 16:38
 */

namespace App\DataFixtures\ORM;


use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadGroups extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $group1 = new TrickGroup();
       $group1->setId(1);
       $group1->setName('Grab');
       $manager->persist($group1);
       $this->addReference('group_grab', $group1);

       $group2 = new TrickGroup();
       $group2->setId(2);
       $group2->setName('Slide');
       $manager->persist($group2);
        $this->addReference('group_slide', $group2);

       $group3 = new TrickGroup();
        $group3->setId(3);
       $group3->setName('Rotation');
       $manager->persist($group3);
        $this->addReference('group_rotation', $group3);

       $group4 = new TrickGroup();
        $group4->setId(4);
       $group4->setName('Ollie');
       $manager->persist($group4);
        $this->addReference('group_ollie', $group4);

       $group5 = new TrickGroup();
        $group5->setId(5);
       $group5->setName('Old School');
       $manager->persist($group5);
        $this->addReference('group_old', $group5);

       $group6 = new TrickGroup();
       $group6->setId(6);
       $group6->setName('Flip');
       $manager->persist($group6);
        $this->addReference('group_flip', $group6);


       $manager->flush();
    }


}