@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="mb-3">
                        <button id="toggleForm" class="btn btn-primary">Switch to Organization</button>
                    </div>

                    <form id="individualForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Registration Type Selection -->
                    
                        <!-- Individual Fields -->
                        <div id="individual_fields">
                            <!-- Name -->
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" required value="{{ old('username') }}" autocomplete="username" name="username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="individual">

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </div>

</form>

<form id="organizationForm" method="POST" action="{{ route('register') }}">
                        @csrf


                        <!-- Organization Fields -->
                        <div id= "fields">
                            <!-- Organization Name -->
                            <div class="row mb-3">
                                <label for= "name" class="col-md-4 col-form-label text-md-end">{{ __('Organization Name') }}</label>
                                <div class="col-md-6">
                                    <input id= "name" type="text" class="form-control" name= "name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <!-- Organization Email -->
                            <div class="row mb-3">
                                <label for= "email" class="col-md-4 col-form-label text-md-end">{{ __('Organization Email') }}</label>
                                <div class="col-md-6">
                                    <input id= "email" type="email" class="form-control" name= "email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>

                            <!-- Organization Username -->
                            <div class="row mb-3">
                                <label for= "username" class="col-md-4 col-form-label text-md-end">{{ __('Organization Username') }}</label>
                                <div class="col-md-6">
                                    <input id= "username" type="text" class="form-control" name= "username" required value="{{ old('username') }}" autocomplete="username">
                                </div>
                            </div>

                            <!-- Organization Password -->
                            <div class="row mb-3">
                                <label for= "password" class="col-md-4 col-form-label text-md-end">{{ __('Organization Password') }}</label>
                                <div class="col-md-6">
                                    <input id= "password" type="password" class="form-control" name= "password" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Confirm Organization Password -->
                            <div class="row mb-3">
                                <label for= "password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Organization Password') }}</label>
                                <div class="col-md-6">
                                    <input id= "password-confirm" type="password" class="form-control" name= "password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="organization">

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleFormButton = document.getElementById('toggleForm');
        const individualForm = document.getElementById('individualForm');
        const organizationForm = document.getElementById('organizationForm');

        // Hide the organization form by default
        organizationForm.style.display = 'none';

        // Toggle between individual and organization forms
        toggleFormButton.addEventListener('click', function () {
            if (individualForm.style.display === 'none') {
                individualForm.style.display = 'block';
                organizationForm.style.display = 'none';
                toggleFormButton.innerText = 'Switch to Organization Form';
            } else {
                individualForm.style.display = 'none';
                organizationForm.style.display = 'block';
                toggleFormButton.innerText = 'Switch to Individual Form';
            }
        });
    });
</script>


@endsection
