<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;


class LeadRepository implements LeadRepositoryInterface
{

   public function list($filter)
    {

    }
    public function save($data){

       if ($lead = Lead::create($data)) {
            return $lead;
        }

        return false;
    }
}
