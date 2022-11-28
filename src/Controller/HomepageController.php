<?php

namespace App\Controller;

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
    public function indexAboutMe(): Response
    {
        return $this->render('about-me.html.twig');
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
    public function indexSkillsetExperiences(): Response
    {
        return $this->render('skillset-experiences.html.twig');
    }
}