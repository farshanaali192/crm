@extends('layout.index')

@section('title', 'Dashboard | CRM')

@section('content')

    <div class="header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome to your CRM management system.</p>
        </div>
    </div>

    <div class="dashboard-cards">

        <div class="card">
            <div class="card-header">
                <div class="card-icon leads-icon">👥</div>
                <h1>{{ $leadsCount }}</h1>
            </div>
            <h3>Leads   </h3>
            <p>Manage potential customers and track prospects.</p>

            <a href="{{ route('leads.list') }}" class="card-link">
                View Leads →
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-icon accounts-icon">🏢</div>
                 <h1>{{ $accountsCount }}</h1>
            </div>
            <h3>Accounts</h3>
            <p>Manage companies and organizations.</p>

            <a href="{{ route('accounts.list') }}" class="card-link">
                View Accounts →
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-icon contacts-icon">📇</div>
                 <h1>{{ $contactsCount }}</h1>
            </div>
            <h3>Contacts</h3>
            <p>Manage people and their contact information.</p>

            <a href="{{ route('contacts.list') }}" class="card-link">
                View Contacts →
            </a>
        </div>

    </div>

@endsection

