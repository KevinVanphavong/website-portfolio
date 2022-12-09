<?php

namespace App\DataFixtures;

use App\Entity\CategoryExperience;
use App\Entity\WorkExperience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryExperiencesFixtures extends Fixture
{
    public const WEB_DEV = 'web-dev';
    public const SALES_MNG = 'sales-management';

    public function load(ObjectManager $manager)
    {
        $categoryExperience1 = new CategoryExperience();
        $categoryExperience2 = new CategoryExperience();

        $categoryExperience1->setTitle('Web Development');
        $categoryExperience2->setTitle('Sales & Management');

        $this->addReference(self::WEB_DEV, $categoryExperience1);
        $this->addReference(self::SALES_MNG, $categoryExperience2);

        $manager->persist($categoryExperience1);
        $manager->persist($categoryExperience2);

        $manager->flush();
    }
}