<?php

namespace App\Repositories\Contacts;

interface ContactRepositoryInterface
{
    public function list($filter);
    public function save($contactableData,$inputData,$type='');

    public function existsForAccount(int $accountId, string $email, string $contactable_type): bool;
}
