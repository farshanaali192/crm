<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\StoreAccountRequest;
use App\Repositories\Account\AccountRepositoryInterface as AccountRepository;
use App\Repositories\Contacts\ContactRepositoryInterface as ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function list(AccountRepository $accountrepo,Request $request)
    {
        $accounts=$accountrepo->list($request->all());
        return view('accounts.listAccounts', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.createAccount');
    }


    public function store(StoreAccountRequest $request,AccountRepository $accountRepository,ContactRepository $contactRepo)
    {
        // dd($request->all());
        try {

            DB::transaction(function () use ($request, $accountRepository, $contactRepo) {

            $data = [
                'company_name' => $request->company_name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'status'       => 'active',
            ];

            $account = $accountRepository->save($data);

            if (!$account) {
                throw new \Exception('Account creation failed.');
            }

            if ($contactRepo->existsForAccount($account->id, $request->email,$contactable_type='account')) {
                 throw new \Exception('This email already exists for this account.');

            }

            $contact = $contactRepo->save( $account, $request, 'account');

            if (!$contact) {
                throw new \Exception('Contact creation failed.');
            }
        });

        return redirect()
            ->route('accounts.create')
            ->with('success', 'Account added successfully');

        } catch (\Throwable $e) {
            // dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Account creation failed. Please try again.');
        }
    }






}
