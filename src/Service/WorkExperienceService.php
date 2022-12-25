<?php

namespace App\Service;

class WorkExperienceService
{
    public function getStartEndDateFromForm(array $formData)
    {
        return new \DateTime($formData['month'] . '/' . $formData['day'] . '/' . $formData['year']);
    }
}