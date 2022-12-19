<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\ProfilePicture;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 */
class AdminController extends AbstractController
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

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
    public function indexProfile(Request $request, ProfileRepository $profileRepository): Response
    {
        // A remplacer le profil actuel du compte
        // $profile => $this->getUser()->getProfile();
        $profile = $profileRepository->findOneBy(['id' => 1]);

        $entityManager = $this->getDoctrine()->getManager();

        $profileForm = $this->createForm(ProfileType::class, $profile);
        $profileForm->handleRequest($request);

        if($profileForm->isSubmitted() && $profileForm->isValid()) {
            $this->profileService->saveProfilePictureForm($profileForm, $profile, $this->getParameter('profile_picture'));

            $entityManager->flush();
            $this->addFlash('success', 'Les modifications faites à votre soirée ont bien été prises en compte');
        }

        return $this->render('admin/profile.html.twig',[
            'profile' => $profile,
            'profileForm' => $profileForm->createView(),
        ]);
    }

    /**
     * @Route("/job-experiences", name="admin-job-experiences")
     */
    public function indexJobExperiences(Request $request)
    {
        return;
    }

    /**
     * @Route("/hbo-studio", name="admin-hbo-studio")
     */
    public function indexHboStudio(Request $request)
    {
        return;
    }

    /**
     * @Route("/inbox", name="admin-inbox")
     */
    public function indexInbox(Request $request)
    {
        return;
    }
}
