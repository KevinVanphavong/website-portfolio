<?php

namespace App\Entity;

use App\Repository\RelatedSocialNetworkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelatedSocialNetworkRepository::class)
 */
class RelatedSocialNetwork
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
    private $name;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $linkURL;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class, inversedBy="relatedSocialNetworks")
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

    public function getLinkURL(): ?string
    {
        return $this->linkURL;
    }

    public function setLinkURL(string $linkURL): self
    {
        $this->linkURL = $linkURL;

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
