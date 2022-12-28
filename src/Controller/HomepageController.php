<?php

namespace App\Controller;

use App\Entity\MessageReceived;
use App\Form\MessageReceivedType;
use App\Repository\CategoryExperienceRepository;
use App\Repository\ProfileRepository;
use App\Repository\WorkExperienceRepository;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexAboutMe(Request $request, ProfileRepository $profileRepository): Response
    {
        // A remplacer le profil actuel du compte
        // $profile => $this->getUser()->getProfile();
        $profile = $profileRepository->findOneBy(['id' => 1]);

        $messageReceivedForm = $this->createForm(MessageReceivedType::class);
        $messageReceivedForm->handleRequest($request);

        if($messageReceivedForm->isSubmitted() && $messageReceivedForm->isValid()) {
            $messageReceived = $request->request->get('message_received');
            $sender = $messageReceived['sender'];

            $timezone = new DateTimeZone($this->getParameter('timezone'));
            $date = new \DateTimeImmutable('now', $timezone);

            $newMessage = new MessageReceived();
            $newMessage->setSendAt($date);
            $newMessage->setSender($sender);
            $newMessage->setEmail($messageReceived['email']);
            $newMessage->setPhoneNumber($messageReceived['phoneNumber']);
            $newMessage->setObject($messageReceived['object']);
            $newMessage->setContent($messageReceived['content']);

            $this->getDoctrine()->getManager()->persist($newMessage);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Thanks ' . $sender . ' for your message ;) . I\'ll be in touch with you ASAP');
            return $this->redirectToRoute('about-me');
        }

        return $this->render('about-me.html.twig', [
            'profile' => $profile,
            'messageReceivedForm' => $messageReceivedForm->createView(),
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