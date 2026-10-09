

@extends('layout.index')

@section('title', 'Accounts | CRM')

@section('content')

    <div class="header">
        <div>
            <h1>Create Lead | CRM</h1>
        </div>
    </div>

   <div class="container">
    <div class="card">
        <p class="subtitle">Add a new lead to your CRM.</p>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('leads.store') }}" method="POST">
            @csrf

            <div class="field">
                <label for="first_name">Company Name *</label>
                <input type="text" id="first_name" name="company_name"
                       value="{{ old('company_name') }}"
                       class="@error('company_name') is-invalid @enderror">
                @error('company_name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="field">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" name="first_name"
                           value="{{ old('first_name') }}"
                           class="@error('first_name') is-invalid @enderror">
                    @error('first_name') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           value="{{ old('last_name') }}"
                           class="@error('last_name') is-invalid @enderror">
                    @error('last_name') <div class="error">{{ $message }}</div> @enderror
                </div>

            </div>

            <div class="row">
                <div class="field">
                    <label for="phone">Phone*</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone') <div class="error">{{ $message }}</div> @enderror
                </div>

              <div class="field">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           class="@error('email') is-invalid @enderror">
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="field ">
                            <label for="status" class="form-label">Status</label>

                            <select name="status"  id="status"class="form-select
                                @error('status') is-invalid @enderror" >
                                <option value="new"
                                    {{ old('status', 'new') == 'new' ? 'selected' : '' }}>
                                    New
                                </option>

                                <option value="contacted"
                                    {{ old('status') == 'contacted' ? 'selected' : '' }}>
                                    Contacted
                                </option>

                                <option value="qualified"
                                    {{ old('status') == 'qualified' ? 'selected' : '' }}>
                                    Qualified
                                </option>
                                <option value="unqualified"
                                    {{ old('status') == 'unqualified' ? 'selected' : '' }}>
                                    Unqualified
                                </option>

                                <option value="converted"
                                    {{ old('status') == 'converted' ? 'selected' : '' }}>
                                    Converted
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

            </div>


            <button type="submit">Create Account</button>
        </form>
    </div>
</div>


@endsection





