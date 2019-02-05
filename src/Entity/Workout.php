<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkoutRepository")
 */
class Workout
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="workouts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Excercise", mappedBy="workout")
     */
    private $excercises;

    public function __construct()
    {
        $this->excercises = new ArrayCollection();
        $this->created_at = new \DateTime();
        $this->status = 1;
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    /**
     * @return Collection|Excercise[]
     */
    public function getExcercises(): Collection
    {
        return $this->excercises;
    }

    public function addExcercise(Excercise $excercise): self
    {
        if (!$this->excercises->contains($excercise)) {
            $this->excercises[] = $excercise;
            $excercise->setWorkout($this);
        }

        return $this;
    }

    public function removeExcercise(Excercise $excercise): self
    {
        if ($this->excercises->contains($excercise)) {
            $this->excercises->removeElement($excercise);
            // set the owning side to null (unless already changed)
            if ($excercise->getWorkout() === $this) {
                $excercise->setWorkout(null);
            }
        }

        return $this;
    }
}
