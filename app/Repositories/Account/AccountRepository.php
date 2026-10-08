<?php

namespace App\Repositories\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;


class AccountRepository implements AccountRepositoryInterface
{

    public function list($filter)
    {

    }
    public function save($data){

       if ($account = Account::create($data)) {
            return $account;
        }

        return false;
    }
}
