<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Form;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CounterRepository")
 */
class Counter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $counter;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="counters")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CounterHistory", mappedBy="counter_id")
     */
    private $counterHistories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $start_counter;

    private $counterHistoryForm;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->counterHistories = new ArrayCollection();
        $this->counter = 0;
    }

    public function getId()
    {
        return $this->id;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCounter(): ?int
    {
        return $this->counter;
    }

    public function setCounter(int $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CounterHistory[]
     */
    public function getCounterHistories(): Collection
    {
        return $this->counterHistories;
    }

    public function addCounterHistory(CounterHistory $counterHistory): self
    {
        if (!$this->counterHistories->contains($counterHistory)) {
            $this->counterHistories[] = $counterHistory;
            $counterHistory->setCounterId($this);
        }

        return $this;
    }

    public function removeCounterHistory(CounterHistory $counterHistory): self
    {
        if ($this->counterHistories->contains($counterHistory)) {
            $this->counterHistories->removeElement($counterHistory);
            // set the owning side to null (unless already changed)
            if ($counterHistory->getCounterId() === $this) {
                $counterHistory->setCounterId(null);
            }
        }

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

    public function getStartCounter(): ?int
    {
        return $this->start_counter;
    }

    public function setStartCounter(int $start_counter): self
    {
        $this->start_counter = $start_counter;

        return $this;
    }

    public function setCounterHistoryForm(Form $form)
    {
        $this->counterHistoryForm = $form->createView();
    }

    public function getCounterHistoryForm()
    {
        return $this->counterHistoryForm;
    }


    public function __toString()
    {
        return "";
    }
}
