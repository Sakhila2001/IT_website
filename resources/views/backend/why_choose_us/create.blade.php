@extends('layouts.app')

@section('title', 'Create Why Choose Us Points')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Why Choose Us Detail</h4>
                            <a href="{{ route('backend.why_choose_us.index') }}" class="btn btn-primary btn-sm ml-auto">Back to Partners</a>
                        </div>
                        <div class="card-body">
                            <!-- Added enctype for file uploads -->
                            <form action="{{ route('backend.why_choose_us.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label>Icon Image (Will be resized to 300x300px)</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" onchange="previewImage(event)">
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Accepted formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB
                                </small>
                                <div class="mt-2">
                                    <img id="imagePreview" src="#" alt="Preview Image" style="display: none; max-width: 150px; border-radius: 10px; border: 1px solid #ddd;">
                                </div>
                            </div>

                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option disabled selected>Choose Option</option>
                                        <option value="Publish" @selected(old('is_publish') == 'Publish')>Publish</option>
                                        <option value="Draft" @selected(old('is_publish') == 'Draft')>Draft</option>
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
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
