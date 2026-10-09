<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name'=>'required|string|max:50|min:1',
            'first_name' => 'required|string|max:50|min:1',
            'last_name' => 'nullable|string|max:100|min:1',
            'phone' => 'required|unique:accounts,phone,NULL,id,deleted_at,NULL|min:5|max:15',
            // 'email' => 'required|email|unique:accounts,email,NULL,id,deleted_at,NULL',
            // 'email' => ['required', 'email',
            //     Rule::unique('contacts', 'email')->where('contactable_type', 'account'),
            // ],
            'email' => [
                'required',
                'email',

                // Unique in accounts
                Rule::unique('accounts', 'email')
                    ->whereNull('deleted_at'),

                // Unique in contacts for account-type contacts,
                Rule::unique('contacts', 'email')
                    ->where('contactable_type', 'account')
                    ->whereNull('deleted_at'),
            ]
        ];
    }

     public function messages()
    {
        return [
            'company_name.required' => ':attribute is required',
            'company_name.max' => ':attribute must be maximum of 50 character',
            'company_name.min' => ':attribute must be minimum of 1 character',
            'first_name.required' => ':attribute is required',
            'first_name.max' => ':attribute must be maximum of 50 character',
            'first_name.min' => ':attribute must be minimum of 1 character',
            'last_name.max' => ':attribute must be maximum of 50 character',
            'last_name.min' => ':attribute must be minimum of 1 character',
            'email.required' => ':attribute is required',
            'phone.required' => ':attribute is required',
            'phone.unique' => ':attribute must be unique',
            'phone.max' => ':attribute must be maximum of 15 character',
            'phone.min' => ':attribute must be minimum of 5 character',
        ];
    }

    public function attributes()
    {
        return [
            'company_name' => 'Company Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',

        ];
    }
}
