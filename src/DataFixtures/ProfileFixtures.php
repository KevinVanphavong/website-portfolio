<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $birthdate = DateTime::createFromFormat('d/m/Y', '17/10/1996');
         $profile = new Profile();
         $profile->setFirstname('Kévin');
         $profile->setLastname('Vong');
         $profile->setBirthdate($birthdate);
         $profile->setSex('Male');
         $profile->setCurrentPosition('Student in Master Degree');
         $profile->setQuickDescription('Creating my own studioAs creative studio and brand design');

         $manager->persist($profile);

        $manager->flush();
    }
}
