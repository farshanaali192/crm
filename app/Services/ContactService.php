<?php

namespace App\Services;

use App\Contracts\ContactSource;
use App\Models\Contact;
use App\Repositories\Contacts\ContactRepository;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

// class ContactService
// {
//     /**
//      * Create a new class instance.
//      */
//   public function __construct(private ContactRepository $contacts) {}

//     public function create(ContactSource $source, array $payload): Contact
//     {
//         $data = $source->toContactData($payload);
//         $data['email'] = strtolower(trim($data['email']));

//         try {
//             return DB::transaction(function () use ($source, $payload, $data) {
//                 $contact = $this->contacts->save($data + ['source' => $source->name()]);
//                 $source->afterCreate($contact, $payload);
//                 return $contact;
//             });
//         } catch (UniqueConstraintViolationException $e) {
//             throw new DuplicateContactException($data['email'], previous: $e);
//         }
//     }


// }

class ContactService
{
    public function __construct(
        private ContactRepository $contactRepository
    ) {}

    public function create(
        ContactSource $source,
        array $data
    ): Contact {
        $contactData = [
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'company_name' => $data['company_name'] ?? null,

            // Information supplied by AccountContactSource
            'contactable_type' => $source->getType(),
            'contactable_id' => $source->getId(),

            'status' => 'active',
        ];

        return $this->contactRepository->save($contactData);
    }
}
