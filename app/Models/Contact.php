<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;


class Contact extends Model
{
    protected $fillable = ['first_name','last_name','email','phone','contactable_type','contactable_id','status'];
    protected $appends = ['company_name'];
    public function getCompanyNameAttribute(): ?string
    {
        return match ($this->contactable_type) {
            'account' => Account::whereKey($this->contactable_id)
                                ->value('company_name'),

            'lead' => Lead::whereKey($this->contactable_id)
                          ->value('company_name'),

            default => null,
        };
    }
}
