{{-- resources/views/accounts/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account | CRM</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }
        .container {
            max-width: 640px;
            margin: 40px auto;
            padding: 0 16px;
        }
        .card {
            background: #fff;
            padding: 28px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        }
        h1 { margin: 0 0 4px; font-size: 22px; }
        .subtitle { margin: 0 0 24px; color: #6b7280; font-size: 14px; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
        }
        .is-invalid { border-color: #dc2626; }
        .error { margin-top: 4px; color: #dc2626; font-size: 13px; }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: #fff;
            border: 0;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        @media (max-width: 520px) { .row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
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
</body>
</html>
