@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Company</h1>
    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" accept=" image/*">
            <small class="form-text text-muted">Current Logo: 
                @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Current Logo" width="100" height="100">
                @else
                    No Logo
                @endif
            </small>
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Company</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection