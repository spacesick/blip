<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Services\Interface\TransactionService;
use App\Services\TransactionServiceImpl;
use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Parser\DecimalMoneyParser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TransactionService::class, TransactionServiceImpl::class);
        $isoCurrencies = new ISOCurrencies();
        $this->app->singleton(DecimalMoneyParser::class, function ($app) use ($isoCurrencies) {
            return new DecimalMoneyParser($isoCurrencies);
        });
        $this->app->singleton(DecimalMoneyFormatter::class, function ($app) use ($isoCurrencies) {
            return new DecimalMoneyFormatter($isoCurrencies);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
