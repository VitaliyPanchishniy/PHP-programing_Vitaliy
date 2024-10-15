<?php

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0; // Мінімальний баланс рахунку

    protected float $balance;
    protected string $currency;

    public function __construct(float $balance, string $currency) {
        $this->balance = $balance;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("Сума для поповнення повинна бути більше 0.");
        }
        $this->balance += $amount;
    }

    public function withdraw(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("Сума для зняття повинна бути більше 0.");
        }

        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів.");
        }

        $this->balance -= $amount;
    }

    public function getBalance(): float {
        return $this->balance;
    }
}
