<?php

namespace App\Service;

use App\Entity\HboStudioImage;
use App\Repository\HboStudioImageRepository;

class HboService
{
    private HboStudioImageRepository $hboStudioImageRepository;

    public function __construct(HboStudioImageRepository $hboStudioImageRepository)
    {
        $this->hboStudioImageRepository = $hboStudioImageRepository;
    }

    public function saveHboStudioImagesForm($hboImages, $entityManager, $pathFile)
    {
        foreach ($hboImages as $image) {
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move($pathFile, $imageName);

            $hboImage = new HboStudioImage();
            $hboImage->setName($imageName);
            $hboImage->setCreatedAt(new \DateTime('now'));
            $this->hboStudioImageRepository->add($hboImage);

            $entityManager->persist($hboImage);
        }
    }
}