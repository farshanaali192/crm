<?php

namespace App\Http\Controllers;
use App\Repositories\Contacts\ContactRepositoryInterface as ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ContactsController extends Controller
{
    public function list(ContactRepository $contactRepo,Request $request)
    {
        $contacts=$contactRepo->list($request->all());
        return view('contacts.listContacts', compact('contacts'));
    }

}
