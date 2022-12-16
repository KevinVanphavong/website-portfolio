<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="admin-dashboard")
     */
    public function indexDashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @Route("/profile", name="admin-profile")
     */
    public function indexProfile(): Response
    {
        return $this->render('admin/profile.html.twig');
    }
}