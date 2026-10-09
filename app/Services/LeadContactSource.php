<?php

namespace App\Services;

use App\Models\Lead;
use App\Contracts\ContactSource;

class LeadContactSource implements ContactSource
{
    /**
     * Create a new class instance.
     */
    public function __construct(private Lead $lead)
    {}

     public function getType(): string
    {
        return 'lead';
    }

    public function getId(): int
    {
        return (int) $this->lead->id;
    }
}
