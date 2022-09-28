<?php

namespace App\DataFixtures;

use App\Entity\User\PlayerUser;
use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerUserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('mail' . $i . '@gmail.com');
            $user->setPassword('abcde');
            $manager->persist($user);

            $playerUser = new PlayerUser($user);
            $playerUser->setGamerTag('gt' . $i);
            $manager->persist($playerUser);
        }

        $manager->flush();
    }
}
