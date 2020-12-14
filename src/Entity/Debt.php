<?php

namespace App\Entity;

use App\Repository\DebtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DebtRepository::class)
 */
class Debt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=UserFake::class, inversedBy="debts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userReceives;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=RUserDebt::class, mappedBy="debt", orphanRemoval=true)
     */
    private $rUserDebts;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSubscription = false;

    public function __construct()
    {
        $this->rUserDebts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUserReceives(): ?UserFake
    {
        return $this->userReceives;
    }

    public function setUserReceives(?UserFake $userReceives): self
    {
        $this->userReceives = $userReceives;

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

    /**
     * @return Collection|RUserDebt[]
     */
    public function getRUserDebts(): Collection
    {
        return $this->rUserDebts;
    }

    public function addRUserDebt(RUserDebt $rUserDebt): self
    {
        if (!$this->rUserDebts->contains($rUserDebt)) {
            $this->rUserDebts[] = $rUserDebt;
            $rUserDebt->setDebt($this);
        }

        return $this;
    }

    public function removeRUserDebt(RUserDebt $rUserDebt): self
    {
        if ($this->rUserDebts->removeElement($rUserDebt)) {
            // set the owning side to null (unless already changed)
            if ($rUserDebt->getDebt() === $this) {
                $rUserDebt->setDebt(null);
            }
        }

        return $this;
    }

    public function getIsSubscription(): ?bool
    {
        return $this->isSubscription;
    }

    public function setIsSubscription(bool $isSubscription): self
    {
        $this->isSubscription = $isSubscription;

        return $this;
    }
}
