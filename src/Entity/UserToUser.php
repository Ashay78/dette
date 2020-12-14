<?php

namespace App\Entity;

class UserToUser
{
    private $firstUser;
    private $secondUser;
    private $amount;

    public function __construct()
    {
        $this->firstUser = new UserFake();
        $this->secondUser = new UserFake();
        $this->amount = 0;
    }

    /**
     * @return UserFake
     */
    public function getFirstUser(): UserFake {
        return $this->firstUser;
    }

    /**
     * @param UserFake $firstUser
     */
    public function setFirstUser(UserFake $firstUser): void
    {
        $this->firstUser = $firstUser;
    }

    /**
     * @return UserFake
     */
    public function getSecondUser(): UserFake
    {
        return $this->secondUser;
    }

    /**
     * @param UserFake $secondUser
     */
    public function setSecondUser(UserFake $secondUser): void
    {
        $this->secondUser = $secondUser;
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
