<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TransactionFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $mockUser = User::factory()
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        Transaction::factory(4)
            ->credit()
            ->for($mockUser)
            ->create();
        Transaction::factory(4)
            ->debit()
            ->for($mockUser)
            ->create();
        Transaction::factory(4)
            ->credit()
            ->for($mockUser)
            ->create();
        Transaction::factory(4)
            ->debit()
            ->for($mockUser)
            ->create();
    }
}
