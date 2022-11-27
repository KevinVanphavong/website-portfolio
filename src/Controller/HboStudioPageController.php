<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HboStudioPageController extends AbstractController
{
    /**
     * @Route("/hbo-studio", name="hbo-studio")
     */
    public function index(): Response
    {
        return $this->render('hbo-studio.html.twig');
    }
}