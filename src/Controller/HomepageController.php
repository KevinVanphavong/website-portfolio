<?php

namespace App\Controller;

use App\Repository\CategoryExperienceRepository;
use App\Repository\ProfileRepository;
use App\Repository\WorkExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexHomepage(): Response
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/about-me", name="about-me")
     */
    public function indexAboutMe( ProfileRepository $profileRepository): Response
    {
        // A remplacer le profil actuel du compte
        // $profile => $this->getUser()->getProfile();
        $profile = $profileRepository->findOneBy(['id' => 1]);

        return $this->render('about-me.html.twig', [
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/hbo-studio", name="hbo-studio")
     */
    public function indexHboStudio(): Response
    {
        return $this->render('hbo-studio.html.twig');
    }

    /**
     * @Route("/skillset-experiences", name="skillset-experiences")
     */
    public function indexSkillsetExperiences(WorkExperienceRepository $workExperienceRepository, CategoryExperienceRepository $categoryExperienceRepository): Response
    {
        return $this->render('skillset-experiences.html.twig', [
            'workExperiences' => $workExperienceRepository->findAll(),
            'categoryExperiences' => $categoryExperienceRepository->findAll()
        ]);
    }
}