<?php

namespace App\Service;

use App\Entity\ProfilePicture;

class ProfileService
{
    public function saveProfilePictureForm($profileForm, $profile, $pathFile)
    {
        $profilePicture = $profileForm->get('profilePicture')->getData();
        if ($profilePicture) {
            $coverName = md5(uniqid()) . '.' . $profilePicture->guessExtension();
            $profilePicture->move($pathFile, $coverName);
            if ($profile->getProfilePicture()) {
                unlink($pathFile . '/' . $profile->getProfilePicture()->getName());
                $profile->getProfilePicture()->setName($coverName);
            } else {
                $profilePicture = new ProfilePicture();
                $profilePicture->setName($coverName);
                $profilePicture->setProfileUser($profile);
                $profile->setProfilePicture($profilePicture);
            }
        }
    }
}