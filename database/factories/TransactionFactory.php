<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'entry' => Transaction::CREDIT,
            'idempotent_key' => $this->faker->uuid(),
            'code' => 'TC/'.date('YmdHis').'/'.bin2hex(random_bytes(3)),
            'amount' => '12000.00',
            'details' => $this->faker->paragraph(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'image_attachment_id' => null,
        ];
    }

    public function debit(): Factory
    {
        return $this->state(function (array $attributes) {
           return [
               'entry' => Transaction::DEBIT,
               'code' => 'TD/'.date('YmdHis').'/'.bin2hex(random_bytes(3)),
               'amount' => '12000.00',
           ];
        });
    }

    public function credit(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'entry' => Transaction::CREDIT,
                'code' => 'TC/'.date('YmdHis').'/'.bin2hex(random_bytes(3)),
                'amount' => '12000.00',
            ];
        });
    }
}
