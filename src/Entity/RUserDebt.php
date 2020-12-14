<?php

namespace App\Entity;

use App\Repository\RUserDebtRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RUserDebtRepository::class)
 */
class RUserDebt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Debt::class, inversedBy="rUserDebts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $debt;

    /**
     * @ORM\ManyToOne(targetEntity=UserFake::class, inversedBy="rUserDebts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userOwe;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $monthSubscription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDebt(): ?Debt
    {
        return $this->debt;
    }

    public function setDebt(?Debt $debt): self
    {
        $this->debt = $debt;

        return $this;
    }

    public function getUserOwe(): ?UserFake
    {
        return $this->userOwe;
    }

    public function setUserOwe(?UserFake $userOwe): self
    {
        $this->userOwe = $userOwe;

        return $this;
    }

    public function getMonthSubscription(): ?float
    {
        return $this->monthSubscription;
    }

    public function setMonthSubscription(?float $monthSubscription): self
    {
        $this->monthSubscription = $monthSubscription;

        return $this;
    }
}
