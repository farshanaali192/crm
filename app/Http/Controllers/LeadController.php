<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreLeadRequest;
use App\Repositories\Contacts\ContactRepository;
use App\Repositories\Lead\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function list()
    {
        $leads=[];
        return view('Leads.listLeads', compact('leads'));
    }

    public function create()
    {
        return view('Leads.createLeads');
    }


    public function store(StoreLeadRequest $request,LeadRepository $leadRepo,ContactRepository $contactRepo)
    {
        // dd($request->all());
        try {

            DB::transaction(function () use ($request, $leadRepo, $contactRepo) {

            $data = [
                'company_name' => $request->company_name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'status'       => 'new',
            ];

            $lead = $leadRepo->save($data);

            if (!$lead) {
                throw new \Exception('Lead creation failed.');
            }

            if ($contactRepo->existsForAccount($lead->id, $request->email,$contactable_type='lead')) {
                 throw new \Exception('This email already exists for this account.');

            }

            $contact = $contactRepo->save( $lead, $request, 'lead');

            if (!$contact) {
                throw new \Exception('Contact creation failed.');
            }
        });

        return redirect()
            ->route('accounts.create')
            ->with('success', 'Lead added successfully');

        } catch (\Throwable $e) {
            // dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Lead creation failed. Please try again.');
        }
    }

}
