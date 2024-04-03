@extends('layouts.app')
@include('components.head')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                


            </div>
            <br>

            <a href="{{ route('tasks.index') }}" class="btn btn-info">View Tasks</a>

            @if (Auth::user()->type == 'organization')
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
            @endif

            @if(Auth::user()->type == 'organization')
            <a href="{{ route('users.index') }}" class="btn btn-info">View Users</a>
            @endif

        </div>
    </div>
</div>
@endsection
