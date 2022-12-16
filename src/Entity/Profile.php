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
     * @ORM\OneToMany(targetEntity=RelatedSocialNetwork::class, mappedBy="profileUser", orphanRemoval=true)
     */
    private $relatedSocialNetworks;

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

    /**
     * @return Collection<int, RelatedSocialNetwork>
     */
    public function getRelatedSocialNetworks(): Collection
    {
        return $this->relatedSocialNetworks;
    }

    public function addRelatedSocialNetwork(RelatedSocialNetwork $relatedSocialNetwork): self
    {
        if (!$this->relatedSocialNetworks->contains($relatedSocialNetwork)) {
            $this->relatedSocialNetworks[] = $relatedSocialNetwork;
            $relatedSocialNetwork->setProfileUser($this);
        }

        return $this;
    }

    public function removeRelatedSocialNetwork(RelatedSocialNetwork $relatedSocialNetwork): self
    {
        if ($this->relatedSocialNetworks->removeElement($relatedSocialNetwork)) {
            // set the owning side to null (unless already changed)
            if ($relatedSocialNetwork->getProfileUser() === $this) {
                $relatedSocialNetwork->setProfileUser(null);
            }
        }

        return $this;
    }
}
