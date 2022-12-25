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
use App\Repository\ProfileRepository;
use App\Repository\WorkExperienceRepository;
use App\Service\ProfileService;
use App\Service\WorkExperienceService;
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
    private $workExperienceService;

    public function __construct(ProfileService $profileService, WorkExperienceService $workExperienceService)
    {
        $this->profileService = $profileService;
        $this->workExperienceService = $workExperienceService;
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
    public function indexJobExperiences(Request $request, ProfileRepository $profileRepository, WorkExperienceRepository $workExperienceRepository, CategoryExperienceRepository $categoryExperienceRepository): Response
    {
        // A remplacer le profil actuel du compte
        // $profile => $this->getUser()->getProfile();
        $profile = $profileRepository->findOneBy(['id' => 1]);

        $workExperienceForm = $this->createForm(WorkExperienceType::class);
        $categoryExperienceForm = $this->createForm(CategoryExperienceType::class);

        $requestFromWorkExpForm = $request->request->get('work_experience');
        $requestFromCategoryExpForm = $request->request->get('category_experience');

        if($requestFromWorkExpForm) {
            $startDate = $this->workExperienceService->getStartEndDateFromForm($requestFromWorkExpForm['startDate']);
            $endDate = $this->workExperienceService->getStartEndDateFromForm($requestFromWorkExpForm['endDate']);
            $relatedCategory = $categoryExperienceRepository->findOneBy(['id' => $requestFromWorkExpForm['categoryExperience']]);
            $newWorkExperience = new WorkExperience();
            $newWorkExperience->setTitle($requestFromWorkExpForm['title']);
            $newWorkExperience->setCompany($requestFromWorkExpForm['company']);
            $newWorkExperience->setPosition($requestFromWorkExpForm['position']);
            $newWorkExperience->setCountry($requestFromWorkExpForm['country']);
            $newWorkExperience->setCity($requestFromWorkExpForm['city']);
            $newWorkExperience->setDescription($requestFromWorkExpForm['description']);
            $newWorkExperience->setCategoryExperience($relatedCategory);
            $newWorkExperience->setStartDate($startDate);
            $newWorkExperience->setEndDate($endDate);
            $this->getDoctrine()->getManager()->persist($newWorkExperience);

            // Traitement de l'image avec Work Experience
            if ($request->files->get('work_experience')){
                $file = $request->files->get('work_experience')['image'];
                $imageName = md5(uniqid()) . '.' . $file->guessExtension();
                $pathFile = $this->getParameter('experience_image');
                $file->move($pathFile, $imageName);
                $workImage = new WorkExperienceImage();
                $workImage->setName($imageName);
                $workImage->setWorkExperience($newWorkExperience);
                $this->getDoctrine()->getManager()->persist($workImage);
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Vous venez d\'ajouter une nouvelle Experience : ' . $requestFromWorkExpForm['title']);
        } elseif ($requestFromCategoryExpForm) {
            $newCategoryExperience = new CategoryExperience();
            $newCategoryExperience->setTitle($requestFromCategoryExpForm['title']);
            $this->getDoctrine()->getManager()->persist($newCategoryExperience);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Vous venez d\'ajouter une nouvelle Category : ' . $requestFromCategoryExpForm['title']);
        }

        return $this->render('admin/skillset-experiences.html.twig',[
            'profile' => $profile,
            'workExperienceForm' => $workExperienceForm->createView(),
            'categoryExperienceForm' => $categoryExperienceForm->createView(),
            'workExperiences' => $workExperienceRepository->findAll(),
            'categoryExperiences' => $categoryExperienceRepository->findAll(),
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
    public function indexInbox(Request $request)
    {
        return;
    }
}
