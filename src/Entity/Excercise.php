<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExcerciseRepository")
 */
class Excercise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workout", inversedBy="excercises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workout;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $repetition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $orderOfExcercise;

    public function getId()
    {
        return $this->id;
    }

    public function getWorkout(): ?Workout
    {
        return $this->workout;
    }

    public function setWorkout(?Workout $workout): self
    {
        $this->workout = $workout;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(?int $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderOfExcercise(): ?int
    {
        return $this->orderOfExcercise;
    }

    public function setOrderOfExcercise(?int $orderOfExcercise): self
    {
        $this->orderOfExcercise = $orderOfExcercise;

        return $this;
    }
}
