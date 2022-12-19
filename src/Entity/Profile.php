<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $currentPosition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $quickDescription;

    /**
     * @ORM\OneToOne(targetEntity=ProfilePicture::class, mappedBy="profileUser", cascade={"persist", "remove"})
     */
    private $profilePicture;

    public function __construct()
    {
        $this->relatedSocialNetworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getCurrentPosition(): ?string
    {
        return $this->currentPosition;
    }

    public function setCurrentPosition(string $currentPosition): self
    {
        $this->currentPosition = $currentPosition;

        return $this;
    }

    public function getQuickDescription(): ?string
    {
        return $this->quickDescription;
    }

    public function setQuickDescription(?string $quickDescription): self
    {
        $this->quickDescription = $quickDescription;

        return $this;
    }

    public function getProfilePicture(): ?ProfilePicture
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(ProfilePicture $profilePicture): self
    {
        // set the owning side of the relation if necessary
        if ($profilePicture->getProfileUser() !== $this) {
            $profilePicture->setProfileUser($this);
        }

        $this->profilePicture = $profilePicture;

        return $this;
    }
}
