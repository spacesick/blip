<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Services\AccountServiceImpl;
use App\Services\CreditCardServiceImpl;
use App\Services\Interface\AccountService;
use App\Services\Interface\CreditCardService;
use App\Services\Interface\TransactionService;
use App\Services\TransactionServiceImpl;
use App\Services\Xendit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Parser\DecimalMoneyParser;
use Xendit\Configuration;
use Xendit\PaymentRequest\PaymentRequestApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Configuration::setXenditKey(config('xendit.key'));
        $this->app->singleton(Xendit::class, function (Application $app) {
            return new Xendit();
        });
        $this->app->singleton(CreditCardService::class, CreditCardServiceImpl::class);

        $this->app->singleton(TransactionService::class, TransactionServiceImpl::class);
        $this->app->singleton(AccountService::class, AccountServiceImpl::class);
        $isoCurrencies = new ISOCurrencies();
        $this->app->singleton(DecimalMoneyParser::class, function (Application $app) use ($isoCurrencies) {
            return new DecimalMoneyParser($isoCurrencies);
        });
        $this->app->singleton(DecimalMoneyFormatter::class, function (Application $app) use ($isoCurrencies) {
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
