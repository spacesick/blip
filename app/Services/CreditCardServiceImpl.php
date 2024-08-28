<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Str;
use Xendit\PaymentMethod\PaymentMethodReusability;
use Xendit\PaymentMethod\PaymentMethodStatus;
use Xendit\PaymentMethod\PaymentMethodType;
use Xendit\PaymentRequest\PaymentRequestApi;

class CreditCardServiceImpl implements Interface\CreditCardService
{
    public function __construct(protected Xendit $xendit) {}

    public function createToken(string $cardNumber, string $cardName, string $cardExpMonth, string $cardExpYear, string $cardCvv): string
    {
        $res = $this->xendit->paymentMethodApi->createPaymentMethod(null, [
            'type' => PaymentMethodType::CARD,
            'reusability' => PaymentMethodReusability::ONE_TIME_USE,
            'card' => [
                'currency' => 'IDR',
                'channel_properties' => [
                    'success_return_url' => 'https://redirect.me/goodstuff',
                    'failure_return_url' => 'https://redirect.me/badstuff',
                ],
                'card_information' => [
                    'card_number' => $cardNumber,
                    'cardholder_name' => $cardName,
                    'expiry_month' => $cardExpMonth,
                    'expiry_year' => $cardExpYear,
                    'cvv' => $cardCvv,
                ]
            ],
        ]);
        if ($res->getStatus() === PaymentMethodStatus::REQUIRES_ACTION) {
            abort(501, 'TODO Requires Action Result');
        }
        elseif ($res->getStatus() === PaymentMethodStatus::PENDING) {
            return $res->getId();
        }
        abort(501, 'Something went wrong.');
    }

    public function charge(string $token, string $authToken, int $amount): mixed
    {
        $externalId = (string) Str::uuid();

        $res = Http::withBasicAuth(
            config('xendit.key'),
            ''
        )->post('https://api.xendit.co/credit_card_charges', [
            'token_id' => $token,
            'authentication_id' => $authToken,
            'external_id' => $externalId,
            'amount' => $amount,
            'currency' => 'IDR',
            'capture' => true,
        ]);

        if ($res->clientError()) {
            return [
                'success' => false,
                'error' => $res->json()['message']
            ];
        }

        $res = $res->json();

        if ($res['external_id'] !== $externalId) {
            return [
                'success' => false,
                'error' => 'External ID mismatch.'
            ];
        }

        if ($res['status'] === 'FAILED') {
            return [
                'success' => false,
                'error' => 'Something went wrong. ('.$res['failure_reason'].')'
            ];
        }

        return [
            'success' => true,
            'error' => 'Success'
        ];
    }
}
