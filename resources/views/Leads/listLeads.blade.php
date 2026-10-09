@extends('layout.index')

@section('title', 'Leads | CRM')

@section('content')

    <div class="header">
        <div>
            <h1>Leads</h1>
            <p>Lead management</p>
        </div>

        <a href="{{ route('leads.create') }}" class="btn-primary">
            + Add Lead
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Leads Table --}}
    <div class="card">

        <h3>All Leads</h3>

        <div class="table-responsive">
            <table id="accountsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($leads as $lead)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->email ?? '-' }}</td>
                            <td>{{ $lead->phone ?? '-' }}</td>
                            <td>{{ ucfirst($lead->status ?? 'N/A') }}</td>
                            <td>
                                {{ $lead->created_at?->format('d M Y') ?? '-' }}
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

