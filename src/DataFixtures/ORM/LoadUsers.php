<?php
namespace App\DataFixtures\ORM;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @property UserPasswordEncoderInterface encoder
 */
class LoadUsers extends Fixture {

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {


        $user1 = new User();
        $user1->setUsername('juju');
        $user1->setEmail('julienbutty@gmail.com');
        $password = $this->encoder->encodePassword($user1, 'pass_123');
        $user1->setPassword($password);
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setAvatar('juju.jpeg');
        $manager->persist($user1);;
        $this->addReference('user1', $user1);


        $user2 = new User();
        $user2->setUsername('Baloo');
        $user2->setEmail('julienbutty+1@gmail.com');
        $password = $this->encoder->encodePassword($user2, 'pass_234');
        $user2->setPassword($password);
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);
        $this->addReference('user2', $user2);

        $manager->flush();
    }

}