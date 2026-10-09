<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\Account\AccountRepository;
use Illuminate\Support\Facades\DB;

class AccountService
{
    /**
     * Create a new class instance.
     */
   public function __construct(
        private AccountRepository $accounts,
        private ContactService $contacts,
    ) {}

    public function create(array $data): Account
    {
        return DB::transaction(function () use ($data) {
            $data['status']='active';
            $account = $this->accounts->save($data);
            $this->contacts->create(new AccountContactSource($account), $data);
            return $account;
        });
    }
}
