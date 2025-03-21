@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</h3>

    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add New Company</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="30" height="30" class="me-2">
                        @else
                            <span class="me-2">No Logo</span>
                        @endif
                        {{ $company->name }}
                    </td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection