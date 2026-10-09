<?php

namespace App\Http\Controllers;

use App\Exceptions\DuplicateContactException;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Repositories\Account\AccountRepositoryInterface as AccountRepository;
use App\Repositories\Contacts\ContactRepositoryInterface as ContactRepository;
use App\Services\AccountService;
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


    public function store(StoreAccountRequest $request, AccountService $accounts)
    {
        try {
            $accounts->create($request->validated());
            return redirect()->route('accounts.create')->with('success', 'Account added successfully');
        } catch (DuplicateContactException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Account creation failed. Please try again.');
        }
    }





}
