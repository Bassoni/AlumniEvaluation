<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 * @UniqueEntity(fields={"degree","year"}, message="il existe deja une Promotion identique")
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Degree", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Year", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?Degree
    {
        return $this->degree;
    }

    public function setDegree(?Degree $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getLabel()
    {
        $degree= $this->getDegree()->getName();
        $year= $this->getYear()->getTitle();

        return $degree ." ". $year;
    }




}
