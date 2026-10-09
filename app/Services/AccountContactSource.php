<?php

namespace App\Services;

use App\Contracts\ContactSource;
use App\Models\Account;

class AccountContactSource implements ContactSource
{
    public function __construct(
        private Account $account
    ) {}

    public function getType(): string
    {
        return 'account';
    }

    public function getId(): int
    {
        return (int) $this->account->id;
    }
}
