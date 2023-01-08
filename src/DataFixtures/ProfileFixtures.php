<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('TseHao');
        $user->setRoles(['ROLE_ADMIN_STAR']);
        $user->setPassword('$2y$13$wnB/MI72xdvC3FE4IPvvoOs6NsxxQA0FZ5pj5M//8a3ujlkxNnV.m');

        $profile = new Profile();
        $birthdate = DateTime::createFromFormat('d/m/Y', '17/10/1996');
        $profile->setFirstname('Kévin');
        $profile->setLastname('Vong');
        $profile->setBirthdate($birthdate);
        $profile->setSex('Male');
        $profile->setCurrentPosition('Student in Master Degree');
        $profile->setQuickDescription('Creating my own studio as creative studio and brand design');

        $this->addReference('tsehao-profile', $profile);
        $user->setProfile($this->getReference('tsehao-profile'));

        $manager->persist($user);
        $manager->persist($profile);

        $manager->flush();
    }
}
