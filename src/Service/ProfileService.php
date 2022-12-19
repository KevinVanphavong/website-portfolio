<?php

namespace App\Service;

use App\Entity\ProfilePicture;

class ProfileService
{
    public function saveProfilePictureForm($profileForm, $profile)
    {
        $profilePicture = $profileForm->get('profilePicture')->getData();
        if ($profilePicture) {
            $coverName = md5(uniqid()) . '.' . $profilePicture->guessExtension();
            $profilePicture->move($this->getParameter('profile_picture'), $coverName);
            if ($profile->getProfilePicture()) {
                unlink($this->getParameter('profile_picture') . '/' . $profile->getProfilePicture()->getName());
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