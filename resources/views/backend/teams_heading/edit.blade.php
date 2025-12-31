@extends('layouts.app')
@section('title', 'Teams Heading Details')

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
    /* .form-control:not(.form-control-sm):not(.form-control-lg) {
      font-size: 14px;
      padding: 3px 15px;
      height: 42px;
    } */
    .tagify {
      --tags-disabled-bg: #F1F1F1;
      --tags-border-color: #DDD;
      --tags-hover-border-color: #CCC;
      --tags-focus-border-color: #8f8f8f;
      width: 100%;
      min-height: 60px;
      max-height: 300px;
      overflow-y: auto;
      padding: 10px;
      line-height: 1.5;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .tall-input {
      min-height: 100px;
      padding: 10px;
      line-height: 1.5;
    }
    .error-message {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

  </style>
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
                            <h4>Teams Heading Details</h4>
                            <a href="{{ route('backend.teams.index') }}" class="btn btn-primary btn-sm ml-auto">Back to the List</a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('backend.teams_heading.update', $teamsHeading->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-section">
                                    <h5 class="section-title">Page Header</h5>
                                    <div class="form-group">
                                        <label>Small Heading</label>
                                        <input type="text" name="small_heading" class="form-control @error('small_heading') is-invalid @enderror"
                                               value="{{ old('small_heading', $teamsHeading->small_heading ?? '') }}" required>
                                        @error('small_heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading</label>
                                        <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror"
                                               value="{{ old('heading', $teamsHeading->heading ?? '') }}" required>
                                        @error('heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Description</label>
                                        <textarea class="summernote @error('heading_description') is-invalid @enderror" name="heading_description" required>
                                            {{ old('heading_description', $teamsHeading->heading_description ?? '') }}
                                        </textarea>
                                        @error('heading_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h5 class="section-title">SEO Settings</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror"
                                                       value="{{ old('seo_title', $teamsHeading->seo_title ?? '') }}" required>
                                                @error('seo_title')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Keywords</label>
                                                <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror tall-input"
                                                       id="seo_keywords_input" value="{{ old('seo_keywords', $teamsHeading->seo_keywords ?? '') }}"
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
                                        <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" required>{{ old('seo_description', $teamsHeading->seo_description ?? '') }}</textarea>
                                        @error('seo_description')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>SEO Image (1200×630 px)</label>
                                        <input type="file" name="seo_image" class="form-control @error('seo_image') is-invalid @enderror" id="seo_image">
                                        @error('seo_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="image-container mt-3" @if(!$teamsHeading->seo_image) style="display: none;" @endif>
                                            @if($teamsHeading->seo_image)
                                                <img src="{{ asset('storage/' . $teamsHeading->seo_image) }}" alt="SEO Image" width="300" class="image-preview" id="seo_image_preview">
                                                <span class="remove-image" onclick="removeImage('seo_image', '#seo_image_preview')">×</span>
                                            @else
                                                <img src="" alt="SEO Image Preview" width="300" class="image-preview" id="seo_image_preview">
                                                <span class="remove-image" onclick="removeImage('seo_image', '#seo_image_preview')">×</span>
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
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
$(document).ready(function() {
    // Initialize Summernote
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

    // Initialize Tagify for SEO Keywords
    const input = document.querySelector('#seo_keywords_input');
    if (input) {
        const tagify = new Tagify(input, {
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

        function updateHeight() {
            const scrollHeight = this.DOM.scope.scrollHeight;
            const minHeight = 60;
            const maxHeight = 300;
            this.DOM.scope.style.height = 'auto';
            this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight) + 'px';
        }
        // Trigger initial height adjustment
        updateHeight.call(tagify);
    }

    // Generic function to preview images
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $(previewId);
                preview.attr('src', e.target.result).show();
                const container = preview.parent('.image-container');
                container.show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Generic function to remove images
    function removeImage(inputId, previewId) {
        const preview = $(previewId);
        preview.attr('src', '').hide();
        $(`#${inputId}`).val('');
        $(`#remove_${inputId}`).val('1');
        preview.parent('.image-container').hide();
    }

    // Image input change handler
    $('#seo_image').change(function() {
        previewImage(this, '#seo_image_preview');
        $('#remove_seo_image').val('0');
    });

    // Auto-expand textarea
    function autoExpand(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

    document.querySelectorAll('.auto-expand').forEach(function(textarea) {
        autoExpand(textarea);
        textarea.addEventListener('input', function() {
            autoExpand(this);
        });
    });
});
</script>
@endsection
