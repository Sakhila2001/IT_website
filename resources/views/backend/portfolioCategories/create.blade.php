@extends('layouts.app')

@section('title', 'Create Portfolio Category')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Portfolio Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.portfolioCategories.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="category"
                                           class="form-control @error('category') is-invalid @enderror"
                                           placeholder="Category Name" value="{{ old('category') }}" required>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if(session('error'))
                                        <div class="invalid-feedback d-block">{{ session('error') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Publish</label>
                                    <select name="is_publish"
                                            class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option disabled {{ old('is_publish') ? '' : 'selected' }}>Choose Option</option>
                                        <option value="Publish" {{ old('is_publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
