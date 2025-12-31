@extends('layouts.app')

@section('title', 'Edit Team')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
<style>
      .note-editor ul {
      list-style-type: disc !important;
      padding-left: 20px !important;
    }
    .note-editor ol {
      list-style-type: decimal !important;
      padding-left: 20px !important;
    }
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
                            <h4>Edit Team</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Personal Info --}}
                                <h5 class="mb-3">Personal Info</h5>
                                <div class="form-group">
                                    <label>Team Member Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $team->name) }}">
                                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Designation</label>
                                    <textarea class="form-control @error('designation') is-invalid @enderror" name="designation">{{ old('designation', $team->designation) }}</textarea>
                                    @error('designation')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                {{-- Image --}}
                                <h5 class="mt-4 mb-3">Profile Image</h5>
                                <div class="form-group">
                                    <label>Current Picture</label><br>
                                    @if($team->image)
                                        <img src="{{ asset('storage/' . $team->image) }}" alt="Current Image" width="70">
                                    @else
                                        No Picture Uploaded
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Change Picture</label>
                                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                                    <img id="imagePreview" class="image-preview" alt="Image Preview">
                                </div>


                                <div class="form-group">
                                    <label>Display Order</label>
                                    <input type="number" name="order" min="1" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $team->order) }}" required>
                                    @error('order')<small class="text-danger">{{ $message }}</small>@enderror
                                    <small class="form-text text-muted">Order must be an integer greater than 0 and unique among active members.</small>
                                </div>

                                {{-- Social Links --}}
                                <h5 class="mt-4 mb-3">Social Media Links</h5>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" value="{{ old('facebook_link', $team->facebook_link) }}">
                                    @error('facebook_link')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>LinkedIn</label>
                                    <input type="text" name="Linkedin_link" class="form-control @error('Linkedin_link') is-invalid @enderror" value="{{ old('Linkedin_link', $team->Linkedin_link) }}">
                                    @error('Linkedin_link')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" value="{{ old('instagram_link', $team->instagram_link) }}">
                                    @error('instagram_link')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" value="{{ old('twitter_link', $team->twitter_link) }}">
                                    @error('twitter_link')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                {{-- Publish --}}
                                <h5 class="mt-4 mb-3">Publishing</h5>
                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option value="Publish" {{ old('is_publish', $team->is_publish) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish', $team->is_publish) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
<script src="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.js') }}"></script>
<script>
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
