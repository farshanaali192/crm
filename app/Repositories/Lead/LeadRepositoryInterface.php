<?php

namespace App\Repositories\Lead;

interface LeadRepositoryInterface
{
    public function list($filter);
    public function save($data);
}
