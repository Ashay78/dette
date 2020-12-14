<?php

namespace App\Entity;

class SettleDebts
{
    private $user;
    private $amount;

    public function __construct()
    {
        $this->user = new UserFake();
        $this->amount = 0;
    }

    /**
     * @return UserFake
     */
    public function getUser(): UserFake {
        return $this->user;
    }

    /**
     * @param UserFake $user
     */
    public function setUser(UserFake $user): void
    {
        $this->user = $user;
    }


    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }


}
