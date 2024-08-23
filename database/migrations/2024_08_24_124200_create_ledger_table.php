<?php

use App\Models\ImageAttachment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ledger', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->enum('entry', [Transaction::CREDIT, Transaction::DEBIT]);
            $table->string('idempotent_key', 36)->unique();
            $table->string('code', 24)->unique();
            $table->decimal('amount', 19, 2);
            $table->text('details')->nullable()->fulltext();
            $table->foreignIdFor(ImageAttachment::class)->nullable()->default(null)->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledger');
    }
};
