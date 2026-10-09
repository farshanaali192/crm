<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Lead;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $accountsCount = Account::count();
        $leadsCount = Lead::count();
        $contactsCount = Contact::count();

        return view('dashboard', compact(
            'accountsCount',
            'leadsCount',
            'contactsCount'
        ));
    }
}
