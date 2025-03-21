@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Company</h1>
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website">
        </div>
        <button type="submit" class="btn btn-success">Add Company</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection