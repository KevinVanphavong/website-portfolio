<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutMePageController extends AbstractController
{
    /**
     * @Route("/about-me", name="about-me")
     */
    public function index(): Response
    {
        return $this->render('about-me.html.twig');
    }
}