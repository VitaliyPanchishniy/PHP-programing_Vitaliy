<?php

function testBankAccounts() {
    try {
        // Створюємо звичайний банківський рахунок
        $account = new BankAccount(100, "USD");
        echo "Баланс рахунку: {$account->getBalance()} USD\n";
        
        // Поповнюємо рахунок
        $account->deposit(50);
        echo "Після поповнення: {$account->getBalance()} USD\n";

        // Знімаємо кошти
        $account->withdraw(30);
        echo "Після зняття: {$account->getBalance()} USD\n";

        // Спроба зняття більшої суми
        $account->withdraw(200); // Очікується виняток

    } catch (Exception $e) {
        echo "Помилка: " . $e->getMessage() . "\n";
    }

    try {
        // Створюємо накопичувальний рахунок
        $savingsAccount = new SavingsAccount(200, "USD");
        echo "\nБаланс накопичувального рахунку: {$savingsAccount->getBalance()} USD\n";

        // Застосовуємо відсотки
        $savingsAccount->applyInterest();
        echo "Після нарахування відсотків: {$savingsAccount->getBalance()} USD\n";

        // Поповнюємо накопичувальний рахунок
        $savingsAccount->deposit(100);
        echo "Після поповнення: {$savingsAccount->getBalance()} USD\n";

        // Спроба зняття некоректної суми
        $savingsAccount->withdraw(-50); // Очікується виняток

    } catch (Exception $e) {
        echo "Помилка: " . $e->getMessage() . "\n";
    }
}

// Викликаємо функцію для тестування
testBankAccounts();
