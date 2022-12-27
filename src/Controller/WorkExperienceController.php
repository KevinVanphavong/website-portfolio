<?php

namespace App\Controller;

use App\Entity\CategoryExperience;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("admin")
 */
class WorkExperienceController extends AbstractController
{
    private $workExperienceService;

    public function __construct(WorkExperienceService $workExperienceService)
    {
        $this->workExperienceService = $workExperienceService;
    }

    /**
     * @Route("/work-experiences", name="admin_work_experiences")
     */
    public function indexWorkExperiences(Request $request, ProfileRepository $profileRepository, WorkExperienceRepository $workExperienceRepository, CategoryExperienceRepository $categoryExperienceRepository): Response
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
            'workExperiences' => $workExperienceRepository->findBy([], ['startDate' => 'DESC']),
            'categoryExperiences' => $categoryExperienceRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/work-experiences/edit/{workExperienceId}", name="edit_work_experience")
     * @ParamConverter("workExperience", class="App\Entity\WorkExperience", options={"mapping": {"workExperienceId": "id"}})
     */
    public function editWorkExperience(Request $request, WorkExperience $workExperience)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $workExperienceForm = $this->createForm(WorkExperienceType::class, $workExperience);
        $workExperienceForm->handleRequest($request);

        if($workExperienceForm->isSubmitted() && $workExperienceForm->isValid()) {
            $this->workExperienceService->saveImageForWorkExperience($workExperienceForm, $workExperience, $this->getParameter('experience_image'));

            $entityManager->flush();
            $this->addFlash('success', 'Modifications has been successfully done on : "' . $workExperience->getTitle() . '"');
            return $this->redirectToRoute('admin_work_experiences');
        }

        return $this->render('admin/edit/e-work-experience.html.twig',[
            'workExperience' => $workExperience,
            'workExperienceForm' => $workExperienceForm->createView(),
        ]);
    }

    /**
     * @Route("/work-experiences/delete/{workExperienceId}", name="delete_work_experience")
     * @ParamConverter("workExperience", class="App\Entity\WorkExperience", options={"mapping": {"workExperienceId": "id"}})
     */
    public function deleteWorkExperience(Request $request, WorkExperience $workExperience)
    {
        if ($this->isCsrfTokenValid('delete'.$workExperience->getId(), $request->request->get('_token')) &&  $request->request->get('_method') === "DELETE") {
            $title = $workExperience->getTitle();
            $entityManager = $this->getDoctrine()->getManager();
            unlink($this->getParameter('experience_image') . '/' . $workExperience->getImage()->getName());
            $entityManager->remove($workExperience);
            $entityManager->flush();

            $this->addFlash('success', 'The work experience : "' . $title . '" has been successfully deleted !');
            return $this->redirectToRoute('admin_work_experiences');
        }
    }

    /**
     * @Route("/category-experiences/delete/{categoryExperienceId}", name="delete_category_experience")
     * @ParamConverter("categoryExperience", class="App\Entity\CategoryExperience", options={"mapping": {"categoryExperienceId": "id"}})
     */
    public function deleteCategoryExperience(Request $request, CategoryExperience $categoryExperience)
    {
        $title = $categoryExperience->getTitle();
        if (count($categoryExperience->getWorkExperiences()) != 0){
            $this->addFlash('alert', 'Impossible to delete : "' . $title . '". There are experiences related to this category. Delete them first!');
        } elseif ($this->isCsrfTokenValid('delete'.$categoryExperience->getId(), $request->request->get('_token')) &&  $request->request->get('_method') === "DELETE") {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryExperience);
            $entityManager->flush();

            $this->addFlash('success', 'The category experience : "' . $title . '" has been successfully deleted !');
        }
        return $this->redirectToRoute('admin_work_experiences');
    }
}