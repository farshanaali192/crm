@extends('layout.index')

@section('title', 'Contacts | CRM')

@section('content')

    <div class="header">
        <div>
            <h1>Contacts</h1>
            <p>Contact management</p>
        </div>

    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Contacts Table --}}
    <div class="card">

        <h3>All Contacts</h3>

        <div class="table-responsive">
            <table id="accountsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Contactable Type</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->first_name }}</td>
                            <td>{{ $contact->last_name }}</td>
                            <td>{{ $contact->company_name }}</td>
                            <td>{{ $contact->email ?? '-' }}</td>
                            <td>{{ $contact->phone ?? '-' }}</td>
                            <td>{{ ucfirst($contact->contactable_type ?? 'N/A') }}</td>
                            <td>{{ ucfirst($contact->status ?? 'N/A') }}</td>
                            <td>
                                {{ $contact->created_at?->format('d M Y') ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        {{-- No records; DataTables will display an empty table. --}}
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection

@push('styles')
    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
@endpush

