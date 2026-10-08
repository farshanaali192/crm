<?php

namespace App\Repositories\Account;

interface AccountRepositoryInterface
{
    public function list($filter);
    public function save($data);

}
