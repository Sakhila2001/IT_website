@extends('layouts.app')
@section('title', 'Why Choose Us Heading Details')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
  <style>
    ul {
      list-style-type: disc !important;
      padding-left: 20px !important;
    }
    ol {
      list-style-type: decimal !important;
      padding-left: 20px !important;
    }
    .note-editor h1 { font-size: 2.5rem !important; font-weight: bold !important; }
    .note-editor h2 { font-size: 2rem !important; font-weight: bold !important; }
    .note-editor h3 { font-size: 1.75rem !important; font-weight: bold !important; }
    .note-editor h4 { font-size: 1.5rem !important; font-weight: bold !important; }
    .note-editor h5 { font-size: 1.25rem !important; font-weight: bold !important; }
    .note-editor h6 { font-size: 1rem !important; font-weight: bold !important; }
    .image-preview {
      max-height: 150px;
      margin-top: 10px;
    }
    .custom-file-label::after {
      content: "Browse";
    }
  </style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @include('_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Why Choose Us Heading Details</h4>
                            <a href="{{ route('backend.why_choose_us.index') }}" class="btn btn-primary btn-sm ml-auto">Back to the List</a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('backend.why_choose_us_heading.update', $chooseHeading->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Small heading</label>
                                    <input type="text" name="small_heading" class="form-control" value="{{ old('small_heading', $chooseHeading->small_heading ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="{{ old('heading', $chooseHeading->heading ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Heading Description</label>
                                    <textarea name="heading_description" class="form-control" required>{{ old('heading_description', $chooseHeading->heading_description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="banner_image" name="banner_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                    <label class="custom-file-label" for="banner_image">Choose image file</label>
                                </div>

                                @if($chooseHeading->banner_image && Storage::disk('public')->exists($chooseHeading->banner_image))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $chooseHeading->banner_image) }}" id="image_preview" class="image-preview" style="max-width: 200px;" alt="Current Image">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                            <label class="form-check-label" for="remove_image">
                                                Remove current image
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <img src="" id="image_preview" class="image-preview d-none" style="max-width: 200px;" alt="Image Preview">
                                    </div>
                                @endif

                                <small class="form-text text-muted">
                                    Recommended size: 725px width, JPEG/PNG format, max 2MB
                                </small>
                            </div>


                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.js') }}"></script>
<script>
    // File input label update
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;

        // Preview image
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image_preview').src = e.target.result;
                document.getElementById('image_preview').classList.remove('d-none');
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Handle remove image checkbox
    document.getElementById('remove_image')?.addEventListener('change', function(e) {
        if (this.checked) {
            document.getElementById('image_preview').classList.add('d-none');
            document.querySelector('.custom-file-label').innerText = 'Choose file';
            document.querySelector('.custom-file-input').value = '';
        } else {
            document.getElementById('image_preview').classList.remove('d-none');
        }
    });
</script>
@endsection
