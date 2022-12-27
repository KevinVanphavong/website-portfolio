<?php

namespace App\Service;

use App\Entity\WorkExperience;
use App\Entity\WorkExperienceImage;

class WorkExperienceService
{
    public function getStartEndDateFromForm(array $formData)
    {
        return new \DateTime($formData['month'] . '/' . $formData['day'] . '/' . $formData['year']);
    }

    public function saveImageForWorkExperience($workExperienceForm, $workExperience, $pathFile)
    {
        $image = $workExperienceForm->get('image')->getData();
        if ($image) {
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move($pathFile, $imageName);
            if ($workExperience->getImage()) {
                unlink($pathFile . '/' . $workExperience->getImage()->getName());
                $workExperience->getImage()->setName($imageName);
            } else {
                $workExperienceImage = new WorkExperienceImage();
                $workExperienceImage->setName($imageName);
                $workExperienceImage->setWorkExperience($workExperience);
                $workExperience->setImage($workExperienceImage);
            }
        }
    }
}