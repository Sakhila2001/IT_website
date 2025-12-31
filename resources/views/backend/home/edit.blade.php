@extends('layouts.app')
@section('title', 'Edit Home Page Details')

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
    .image-preview {
      max-width: 100%;
      height: auto;
      margin-top: 10px;
      border: 1px solid #ddd;
      padding: 5px;
    }
    .image-container {
      position: relative;
      display: inline-block;
    }
    .remove-image {
      position: absolute;
      top: 5px;
      right: 5px;
      background: rgba(0,0,0,0.5);
      color: white;
      border-radius: 50%;
      width: 25px;
      height: 25px;
      text-align: center;
      line-height: 25px;
      cursor: pointer;
    }
    .form-control:not(.form-control-sm):not(.form-control-lg) {
      font-size: 14px;
      padding: 3px 15px;
      height: 42px;
    }
    .auto-expand {
      min-height: 100px;
      max-height: 300px;
      overflow-y: auto;
      resize: none;
      transition: height 0.2s ease;
    }
    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      margin: 20px 0 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    .form-section {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 25px;
    }
    .preview-container {
      margin-top: 10px;
    }
    .preview-container img {
      max-width: 200px;
      max-height: 200px;
      border: 1px solid #ddd;
      padding: 5px;
    }
    .error-message {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }
    /* Tagify specific styles */
    .tagify {
      --tags-disabled-bg: #F1F1F1;
      --tags-border-color: #DDD;
      --tags-hover-border-color: #CCC;
      --tags-focus-border-color: #8f8f8f;
      --tag-bg: #E5E5E5;
      --tag-hover: #D3E2E2;
      --tag-text-color: black;
      --tag-text-color--edit: black;
      --tag-pad: 0 0.5rem;
      --tag-inset-shadow-size: 1rem;
      --tag-invalid-color: #D39494;
      --tag-invalid-bg: rgba(211, 148, 148, 0.5);
      --tag-remove-bg: rgba(211, 148, 148, 0.3);
      --tag-remove-btn-color: black;
      --tag-remove-btn-bg: none;
      --tag-remove-btn-bg--hover: #c77777;
      --input-color: inherit;
      --placeholder-color: rgba(0, 0, 0, 0.4);
      --placeholder-color-focus: rgba(0, 0, 0, 0.2);
      --loader-size: 0.8rem;
      width: 100%;
      min-height: 42px;
      max-height: 200px;
      overflow-y: auto;
      padding: 5px;
      line-height: 1.5;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .tagify:hover {
      border-color: #b1b7bd;
    }
    .tagify:focus-within {
      border-color: #8f8f8f;
      box-shadow: 0 0 0 0.2rem rgba(143, 143, 143, 0.25);
    }
    .tagify__input {
      margin: 5px 0;
      padding: 5px;
      font-size: 14px;
    }
    .tagify__tag {
      margin: 3px;
      padding: 3px 8px;
      border-radius: 3px;
      background: #f0f0f0;
      color: #333;
    }
    .tagify__tag__removeBtn {
      color: #999;
      margin-left: 5px;
      transition: all 0.2s;
    }
    .tagify__tag__removeBtn:hover {
      color: #fff;
      background: #c77777;
    }
    .tagify__tag--editable .tagify__tag__removeBtn {
      display: none;
    }
    .tagify__tag--editable .tagify__tag__removeBtn:hover {
      display: inline-block;
    }
  </style>
  {{-- Include Tagify CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
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
                            <h4>Edit Home Page Details</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('backend.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hot Heading Section</label>
                                    <input type="text" class="form-control" name="hot_heading_section"
                                           value="{{ old('hot_heading_section', $home->hot_heading_section ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>Heading *</label>
                                    <input type="text" class="form-control" name="heading" required
                                           value="{{ old('heading', $home->heading ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>Heading Description</label>
                                    <textarea class="form-control" name="heading_description"
                                              rows="3">{{ old('heading_description', $home->heading_description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Hero Section Background Image</label>
                                    <input type="file" name="hero_background_image[]" class="form-control" id="hero_background_image" multiple>
                                    @error('hero_background_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-3" id="hero_images_preview_container">
                                        @php
                                        $heroImages = is_array($home->hero_background_image)
                                            ? $home->hero_background_image
                                            : json_decode($home->hero_background_image, true);
                                    @endphp

                                    @if(!empty($heroImages))
                                        @foreach($heroImages as $image)
                                            <div class="image-container">
                                                <img src="{{ asset('storage/' . $image) }}" width="200" class="image-preview">
                                                <span class="remove-image" onclick="removeHeroImage(this, '{{ $image }}')">×</span>
                                            </div>
                                        @endforeach
                                    @endif


                                    </div>
                                    <input type="hidden" name="remove_hero_background_image" id="remove_hero_background_image" value="">


                                <!-- SEO Settings Section -->
                                <div class="form-section">
                                    <h5 class="section-title">SEO Settings</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror"
                                                       value="{{ old('seo_title', $home->seo_title ?? '') }}">
                                                @error('seo_title')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Keywords</label>
                                                <input name="seo_keywords"
                                                       class="form-control @error('seo_keywords') is-invalid @enderror"
                                                       id="seo_keywords_input"
                                                       value="{{ old('seo_keywords', $home->seo_keywords ?? '') }}"
                                                       placeholder="Type keywords and press enter">
                                                @error('seo_keywords')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SEO Description</label>
                                        <textarea name="seo_description" class="form-control auto-expand @error('seo_description') is-invalid @enderror">{{ old('seo_description', $home->seo_description ?? '') }}</textarea>
                                        @error('seo_description')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>SEO Image (1200×630 px)</label>
                                        <input type="file" name="seo_image" class="form-control @error('seo_image') is-invalid @enderror" id="seo_image">
                                        @error('seo_image')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="preview-container">
                                            @if($home->seo_image ?? false)
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/' . $home->seo_image) }}" class="seo-image-preview" width="200" alt="SEO Image">
                                                    <span class="remove-image" onclick="removeImage('seo_image')">×</span>
                                                </div>
                                            @else
                                                <img src="" class="seo-image-preview" style="display: none;" width="200" alt="SEO Image Preview">
                                            @endif
                                        </div>
                                        <input type="hidden" name="remove_seo_image" id="remove_seo_image" value="0">
                                    </div>
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
{{-- Include Tagify JS --}}
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

        $('#hero_background_image').on('change', function() {
    $('#hero_images_preview_container').html(''); // clear previous previews
    if(this.files) {
        Array.from(this.files).forEach(file => {
            var reader = new FileReader();
            reader.onload = function(e) {
                var html = `<div class="image-container">
                    <img src="${e.target.result}" width="200" class="image-preview">
                    <span class="remove-image" onclick="removeHeroImage(this)">×</span>
                </div>`;
                $('#hero_images_preview_container').append(html);
            }
            reader.readAsDataURL(file);
        });
    }
});

// Remove image preview
window.removeHeroImage = function(el, imagePath=null) {
    if(imagePath) {
        let removedImages = $('#remove_hero_background_image').val();
        removedImages += imagePath + ',';
        $('#remove_hero_background_image').val(removedImages);
    }
    $(el).closest('.image-container').remove();
}
        // Initialize Tagify for SEO Keywords
        var input = document.querySelector('#seo_keywords_input');
        var tagify = new Tagify(input, {
            whitelist: [],
            dropdown: {
                maxItems: 20,
                enabled: 0,
                closeOnSelect: false
            },
            callbacks: {
                add: updateHeight,
                remove: updateHeight
            }
        });

        // Initial height update
        updateHeight.call(tagify);

        function updateHeight() {
            // Calculate the required height based on content
            const scrollHeight = this.DOM.scope.scrollHeight;
            const minHeight = 42; // Minimum height in pixels
            const maxHeight = 200; // Maximum height in pixels

            // Set the height, ensuring it stays within bounds
            this.DOM.scope.style.height = 'auto';
            this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight) + 'px';
        }

        // Also update height when window is resized
        window.addEventListener('resize', function() {
            updateHeight.call(tagify);
        });

        // Image preview for SEO image
        $('#seo_image').change(function() {
            previewImage(this, '.seo-image-preview');
            $('#remove_seo_image').val('0');
        });

        // Function to preview image
        function previewImage(input, previewClass) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewClass).attr('src', e.target.result).show();
                    $(previewClass).parent('.image-container').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Function to remove image
        window.removeImage = function(type) {
            if (type === 'seo_image') {
                $('.seo-image-preview').attr('src', '').hide();
                $('#remove_seo_image').val('1');
                $('#seo_image').val('');
            }
        }
    });

    // Auto-expanding textarea for SEO Description
    function autoExpand(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

    // Apply to all auto-expand textareas
    document.querySelectorAll('.auto-expand').forEach(function(textarea) {
        // Initial adjustment
        autoExpand(textarea);

        // Adjust on input
        textarea.addEventListener('input', function() {
            autoExpand(this);
        });

        // Adjust when content is pre-filled
        window.addEventListener('load', function() {
            autoExpand(textarea);
        });
    });


</script>
@endsection