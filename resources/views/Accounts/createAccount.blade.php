

@extends('layout.index')

@section('title', 'Accounts | CRM')

@section('content')

    <div class="header">
        <div>
            <h1>Account | CRM</h1>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h1>Create Account</h1>
            <p class="subtitle">Add a new company to your CRM.</p>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="company_name">Company Name *</label>
                    <input type="text" id="company_name" name="company_name"
                        value="{{ old('company_name') }}"
                        class="@error('company_name') is-invalid @enderror">
                    @error('company_name') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="field">
                        <label for="first_name">Contact Person First Name*</label>
                        <input type="text" id="first_name" name="first_name"
                            value="{{ old('first_name') }}"
                            class="@error('first_name') is-invalid @enderror">
                        @error('first_name') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field">
                        <label for="last_name">Contact Person Last Name</label>
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


                <button type="submit">Create Account</button>
            </form>
        </div>
    </div>


@endsection




