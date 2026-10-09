<?php

namespace App\Http\Controllers;

use App\Exceptions\DuplicateContactException;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Repositories\Contacts\ContactRepository;
use App\Repositories\Lead\LeadRepository;
use App\Services\LeadService;
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


     public function store(StoreLeadRequest $request, LeadService $leadService)
    {
        try {
            $leadService->create($request->validated());
            return redirect()->route('leads.create')->with('success', 'Lead added successfully');
        } catch (DuplicateContactException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Lead creation failed. Please try again.');
        }
    }

}
