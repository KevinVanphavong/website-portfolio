<?php

namespace App\DataFixtures;

use App\Entity\WorkExperience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WorkExperiencesFixtures extends Fixture implements DependentFixtureInterface
{
    const WORKEXPFIXTURES = [
        [
            'title' => 'Bachelor degree in Business Development',
            'company' => 'ESCEM - Excelia',
            'position' => 'student' ,
            'startDate' => '09/01/2014',
            'endDate' => '08/01/2017',
            'country' => 'FRANCE',
            'city' => 'Orleans (45)',
            'description' => ''
        ],
        [
            'title' => 'Sales professional',
            'company' => 'Pum Plastiques',
            'position' => 'intern' ,
            'startDate' => '09/01/2016',
            'endDate' => '08/01/2017',
            'country' => 'FRANCE',
            'city' => 'Orleans (45)',
            'description' => ''
        ],
        [
            'title' => 'Business Developer',
            'company' => 'Bowling World',
            'position' => 'worker' ,
            'startDate' => '09/01/2017',
            'endDate' => '08/01/2020',
            'country' => 'FRANCE',
            'city' => 'Blois (41)',
            'description' => ''
        ],
        [
            'title' => 'Degree in Web Development and Web Mobile Development',
            'company' => 'Wild Code School',
            'position' => 'student' ,
            'startDate' => '09/01/2020',
            'endDate' => '02/01/2021',
            'country' => 'FRANCE',
            'city' => 'Orleans (41)',
            'description' => ''
        ],
        [
            'title' => 'Bachelor Degree in Web & Technologies',
            'company' => 'Webtech Institute',
            'position' => 'student' ,
            'startDate' => '09/01/2021',
            'endDate' => '08/01/2022',
            'country' => 'FRANCE',
            'city' => 'Lyon (69)',
            'description' => ''
        ],
        [
            'title' => 'Master Degree in IT project management',
            'company' => 'IPI School',
            'position' => 'student' ,
            'startDate' => '09/01/2022',
            'endDate' => '08/01/2024',
            'country' => 'FRANCE',
            'city' => 'Lyon (69)',
            'description' => ''
        ],
    ];

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        foreach (self::WORKEXPFIXTURES as $index => $work) {
            $startDate = new \DateTime($work['startDate']);
            $endDate = new \DateTime($work['endDate']);
            $workExperience = new WorkExperience();
            $workExperience->setTitle($work['title']);
            $workExperience->setCompany($work['company']);
            $workExperience->setPosition($work['position']);
            $workExperience->setStartDate($startDate);
            $workExperience->setEndDate($endDate);
            $workExperience->setCountry($work['country']);
            $workExperience->setCity($work['city']);
            $workExperience->setDescription($work['description']);

            if($index%3 === 0){
                $workExperience->setCategoryExperience($this->getReference(CategoryExperiencesFixtures::WEB_DEV));
            } else {
                $workExperience->setCategoryExperience($this->getReference(CategoryExperiencesFixtures::SALES_MNG));
            }
            $manager->persist($workExperience);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryExperiencesFixtures::class,
        ];
    }
}