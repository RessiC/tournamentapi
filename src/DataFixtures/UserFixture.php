<?php

namespace App\DataFixtures;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('mail1' . $i . '@gmail.com');
            $user->setPassword('abcde1');
            $user->setGamerTag('gt1' . $i);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
