<?php

namespace App\Entity;

use App\Repository\WorkExperienceImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkExperienceImageRepository::class)
 */
class WorkExperienceImage
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
     * @ORM\OneToOne(targetEntity=WorkExperience::class, inversedBy="image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $workExperience;

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

    public function getWorkExperience(): ?WorkExperience
    {
        return $this->workExperience;
    }

    public function setWorkExperience(WorkExperience $workExperience): self
    {
        $this->workExperience = $workExperience;

        return $this;
    }
}
