<?php

namespace App\Repositories\Contacts;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;


class ContactRepository implements ContactRepositoryInterface
{

    public function list($filter)
    {
        return $contacts= Contact::get();
    }

    public function save($contactableData,$inputData,$type='')
    {
        $data=[
            'first_name'=>$inputData->first_name,
            'last_name'=>$inputData->last_name,
            'email'=>$contactableData->email,
            'phone'=>$contactableData->phone,
            'contactable_type'=>$type,
            'contactable_id'=>$contactableData->id,
            'status'=>'active'
        ];
        if ($contact = Contact::create($data)) {
            return $contact;
        }

        return false;
    }

    public function existsForAccount(int $accountId, string $email, string $contactable_type ): bool
    {
        return Contact::where('contactable_id', $accountId)
            ->where('contactable_type', $contactable_type)
            ->where('email', $email)
            ->whereNull('deleted_at')
            ->exists();
    }
}
