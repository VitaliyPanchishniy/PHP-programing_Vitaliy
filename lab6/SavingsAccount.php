<?php

class SavingsAccount extends BankAccount {
    public static float $interestRate = 0.05; // 5% ставка

    public function applyInterest(): void {
        $this->balance += $this->balance * self::$interestRate;
    }
}
