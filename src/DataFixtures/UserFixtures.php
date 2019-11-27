<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $count    = 0;
        $userInfo = [
            "user@gmail.com" => [],
            "admin@gmail.com" => ["ROLE_ADMIN"],
            "author@gmail.com" => ["ROLE_AUTHOR"],
            "author2@gmail.com" => ["ROLE_AUTHOR"],
        ];

        foreach($userInfo as $email=>$role){

            $user = new User();
            $user->setLastName($faker->lastName());
            $user->setFirstName($faker->firstName());
            $user->setEmail($email);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $email));
            $user->setRoles($role);
            $manager->persist($user);

            $this->addReference('USER'.$count, $user);
            $count++;

            $manager->flush();
        }
    }
}
