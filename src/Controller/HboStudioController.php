<?php

namespace App\Controller;

use App\Entity\HboStudioImage;
use App\Form\HboStudioImageType;
use App\Repository\HboStudioImageRepository;
use App\Service\HboService;
use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('admin')]
class HboStudioController extends AbstractController
{
    /**
     * @var HboService
     */
    private HboService $hboService;

    public function __construct(HboService $hboService)
    {
        $this->hboService = $hboService;
    }

    #[Route('/hbo-studio', name: 'admin_hbo_studio')]
    public function indexHboStudio(Request $request, HboStudioImageRepository $hboStudioImageRepository)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $hboForm = $this->createForm(HboStudioImageType::class);
        $hboForm->handleRequest($request);

        if($hboForm->isSubmitted() && $hboForm->isValid()) {
            $hboImages = $hboForm->get('HboStudioImage')->getData();
            if(count($hboImages) !== 0){
                $this->hboService->saveHboStudioImagesForm($hboImages, $entityManager, $this->getParameter('hbo_studio_images'));
                $this->addFlash('success', 'All the images have been successfully uploaded !');
                $entityManager->flush();
            }
        }

        $hboStudioImages = $hboStudioImageRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('admin/hbo-studio.html.twig', [
            'hboForm' => $hboForm->createView(),
            'hboImages' => $hboStudioImages
        ]);
    }

    /**
     * @ParamConverter("hboImage", class="App\Entity\HboStudioImage", options={"mapping": {"hboImageId": "id"}})
     */
    #[Route('/hbo-studio/delete/{hboImageId}', name: 'delete_hbo_image')]
    public function deleteHboImage(Request $request, HboStudioImage $hboImage)
    {
        if ($this->isCsrfTokenValid('delete'.$hboImage->getId(), $request->request->get('_token')) &&  $request->request->get('_method') === "DELETE") {
            unlink($this->getParameter('hbo_studio_images') . '/' . $hboImage->getName());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hboImage);
            $entityManager->flush();

            $this->addFlash('success', 'Your image has been successfully deleted !');
            return $this->redirectToRoute('admin_hbo_studio');
        }
    }
}