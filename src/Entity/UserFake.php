<?php

namespace App\Entity;

use App\Repository\UserFakeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserFakeRepository::class)
 */
class UserFake
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity=Debt::class, mappedBy="userReceives", orphanRemoval=true)
     */
    private $debts;

    /**
     * @ORM\OneToMany(targetEntity=RUserDebt::class, mappedBy="userOwe", orphanRemoval=true)
     */
    private $rUserDebts;

    public function __construct()
    {
        $this->debts = new ArrayCollection();
        $this->rUserDebts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Debt[]
     */
    public function getDebts(): Collection
    {
        return $this->debts;
    }

    public function addDebt(Debt $debt): self
    {
        if (!$this->debts->contains($debt)) {
            $this->debts[] = $debt;
            $debt->setUserReceives($this);
        }

        return $this;
    }

    public function removeDebt(Debt $debt): self
    {
        if ($this->debts->removeElement($debt)) {
            // set the owning side to null (unless already changed)
            if ($debt->getUserReceives() === $this) {
                $debt->setUserReceives(null);
            }
        }

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
            $rUserDebt->setUserOwe($this);
        }

        return $this;
    }

    public function removeRUserDebt(RUserDebt $rUserDebt): self
    {
        if ($this->rUserDebts->removeElement($rUserDebt)) {
            // set the owning side to null (unless already changed)
            if ($rUserDebt->getUserOwe() === $this) {
                $rUserDebt->setUserOwe(null);
            }
        }

        return $this;
    }
}
