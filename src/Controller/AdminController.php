<?php

namespace App\Controller;

use App\Entity\CategoryExperience;
use App\Entity\Profile;
use App\Entity\ProfilePicture;
use App\Entity\WorkExperience;
use App\Entity\WorkExperienceImage;
use App\Form\CategoryExperienceType;
use App\Form\ProfileType;
use App\Form\WorkExperienceType;
use App\Repository\CategoryExperienceRepository;
use App\Repository\MessageReceivedRepository;
use App\Repository\ProfileRepository;
use App\Repository\WorkExperienceRepository;
use App\Service\ProfileService;
use App\Service\WorkExperienceService;
use DateTime;
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
    public function indexDashboard(
        Request $request,
        ProfileRepository $profileRepository,
        WorkExperienceRepository $workExperienceRepository,
        MessageReceivedRepository $inboxRepository
    ): Response {
        // A remplacer le profil actuel du compte
        // $profile => $this->getUser()->getProfile();
        $profile = $profileRepository->findOneBy(['id' => 1]);
        $workExperiences = $workExperienceRepository->findBy([], ['startDate' => 'DESC']);
        $inbox = $inboxRepository->findBy([], ['sendAt' => 'DESC']);

        return $this->render('admin/dashboard.html.twig', [
            'profile' => $profile,
            'workExperiences' => $workExperiences,
            'inbox' => $inbox
        ]);
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
     * @Route("/hbo-studio", name="admin-hbo-studio")
     */
    public function indexHboStudio(Request $request)
    {
        return;
    }

    /**
     * @Route("/inbox", name="admin-inbox")
     */
    public function indexInbox(Request $request, MessageReceivedRepository $messageReceivedRepository)
    {
        $allMessages = $messageReceivedRepository->findBy([], ['sendAt' => 'DESC']);

        return $this->render('admin/inbox.html.twig',[
            'allMessages' => $allMessages,
        ]);
    }
}
