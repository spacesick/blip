<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountServiceImpl implements Interface\AccountService
{

    public function getUserBalance(): string
    {
        return Account::whereUserId(Auth::id())->first('balance')['balance'];
    }
}
