<?php

namespace App\Services\Interface;

interface CreditCardService
{
    public function createToken(string $cardNumber, string $cardName, string $cardExpMonth, string $cardExpYear, string $cardCvv): string;

    public function charge(string $token, int $amount): void;

//    public function refund(string $token, int $amount): void;
//
//    public function chargeWithCard(string $cardNumber, string $cardName, string $cardExpMonth, string $cardExpYear, string $cardCvv, int $amount): void;
//
//    public function refundWithCard(string $cardNumber, string $cardName, string $cardExpMonth, string $cardExpYear, string $cardCvv, int $amount): void;
//
//    public function chargeWithSavedCard(string $cardToken, int $amount): void;
//
//    public function refundWithSavedCard(string $cardToken, int $amount): void;
//
//    public function saveCard(string $cardNumber, string $cardName, string $cardExpMonth, string $cardExpYear, string $cardCvv): string;
//
//    public function getCard(string $cardToken): array;
//
//    public function deleteCard(string $cardToken): void;
//
//    public function getSavedCards(): array;
//
//    public function getCardTransactions(string $cardToken): array;
//
//    public function getCardTransaction(string $cardToken, string $transactionToken): array;
}
