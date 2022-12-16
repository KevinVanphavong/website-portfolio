<?php

namespace App\Entity;

use App\Repository\ProfilePictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilePictureRepository::class)
 */
class ProfilePicture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $profileUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProfileUser(): ?Profile
    {
        return $this->profileUser;
    }

    public function setProfileUser(?Profile $profileUser): self
    {
        $this->profileUser = $profileUser;

        return $this;
    }
}
