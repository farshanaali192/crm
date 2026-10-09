<?php

namespace App\Services;

use App\Models\Lead;
use App\Repositories\Lead\LeadRepository;
use Illuminate\Support\Facades\DB;

class LeadService
{
    /**
     * Create a new class instance.
     */
    public function __construct(   private LeadRepository $leadRepo,
        private ContactService $contacts )
    {}

    public function create(array $data): Lead
    {
        return DB::transaction(function () use ($data) {
            $lead = $this->leadRepo->save($data);
            $this->contacts->create(new LeadContactSource($lead), $data);
            return $lead;
        });
    }
}
