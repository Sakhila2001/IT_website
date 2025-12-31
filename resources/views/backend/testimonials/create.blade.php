@extends('layouts.app')

@section('title', 'Create Testimonial')

@section('style')
    <!-- Summernote CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
    <style>
        .note-editor ul { list-style-type: disc !important; padding-left: 20px !important; }
        .note-editor ol { list-style-type: decimal !important; padding-left: 20px !important; }
        .note-editor h1 { font-size: 2.5rem !important; font-weight: bold !important; }
        .note-editor h2 { font-size: 2rem !important; font-weight: bold !important; }
        .note-editor h3 { font-size: 1.75rem !important; font-weight: bold !important; }
        .note-editor h4 { font-size: 1.5rem !important; font-weight: bold !important; }
        .note-editor h5 { font-size: 1.25rem !important; font-weight: bold !important; }
        .note-editor h6 { font-size: 1rem !important; font-weight: bold !important; }
        .image-preview { max-width: 100%; margin-top: 10px; display: none; }
    </style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Create Testimonial</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Testimonial Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" placeholder="Designation" value="{{ old('designation') }}">
                                    @error('designation')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Rating (1-5)</label>
                                    <select name="rating" class="form-control @error('rating') is-invalid @enderror">
                                        <option disabled selected>Choose Rating</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                    @error('rating')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
                                    @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Testimonial Picture</label>
                                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                                    <img id="imagePreview" class="image-preview" alt="Image Preview">
                                </div>

                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror">
                                        <option disabled selected>Choose Option</option>
                                        <option value="Publish" {{ old('is_publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')<small class="text-danger">{{ $message }}</small>@enderror
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

@section('scripts')
    <!-- Summernote JS -->
    <script src="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 120
            });
        });

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
