@extends('layouts.app')
@section('title', 'Career Heading Details')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />

<style>
/* --- Summernote styling --- */
.note-editor ul { list-style-type: disc !important; padding-left: 20px !important; }
.note-editor ol { list-style-type: decimal !important; padding-left: 20px !important; }
.note-editor h1 { font-size: 2.5rem !important; font-weight: bold !important; }
.note-editor h2 { font-size: 2rem !important; font-weight: bold !important; }
.note-editor h3 { font-size: 1.75rem !important; font-weight: bold !important; }
.note-editor h4 { font-size: 1.5rem !important; font-weight: bold !important; }
.note-editor h5 { font-size: 1.25rem !important; font-weight: bold !important; }
.note-editor h6 { font-size: 1rem !important; font-weight: bold !important; }

/* --- Image preview --- */
.image-preview { max-width: 100%; height: auto; margin-top: 10px; border: 1px solid #ddd; padding: 5px; }
.image-container { position: relative; display: inline-block; }
.remove-image { position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.5); color: white; border-radius: 50%; width: 25px; height: 25px; text-align: center; line-height: 25px; cursor: pointer; }

/* --- Form --- */
.form-control:not(.form-control-sm):not(.form-control-lg) { font-size: 14px; padding: 3px 15px; height: 42px; }
.auto-expand { min-height: 100px; max-height: 300px; overflow-y: auto; resize: none; transition: height 0.2s ease; }
.section-title { font-size: 1.2rem; font-weight: 600; margin: 20px 0 15px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
.form-section { background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 25px; }
.preview-container { margin-top: 10px; }
.preview-container img { max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; }
.error-message { color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; }

/* --- Tagify --- */
.tagify { width: 100%; min-height: 42px; max-height: 200px; overflow-y: auto; padding: 5px; line-height: 1.5; border: 1px solid #ced4da; border-radius: 0.25rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
.tagify:hover { border-color: #b1b7bd; }
.tagify:focus-within { border-color: #8f8f8f; box-shadow: 0 0 0 0.2rem rgba(143, 143, 143, 0.25); }
.tagify__input { margin: 5px 0; padding: 5px; font-size: 14px; }
.tagify__tag { margin: 3px; padding: 3px 8px; border-radius: 3px; background: #f0f0f0; color: #333; }
.tagify__tag__removeBtn { color: #999; margin-left: 5px; transition: all 0.2s; }
.tagify__tag__removeBtn:hover { color: #fff; background: #c77777; }
.tagify__tag--editable .tagify__tag__removeBtn { display: none; }
.tagify__tag--editable .tagify__tag__removeBtn:hover { display: inline-block; }
</style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')

                    {{-- Display all validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Career Information</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('backend.career_heading.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Header Section --}}
                                <div class="form-section">
                                    <h5 class="section-title">Header Information</h5>

                                    <div class="form-group">
                                        <label>Small Heading</label>
                                        <input type="text" id="small_heading" name="small_heading"
                                            class="form-control @error('small_heading') is-invalid @enderror"
                                            value="{{ old('small_heading', $careerHeading->small_heading ?? '') }}" required>
                                        @error('small_heading')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Heading</label>
                                        <input type="text" id="heading" name="heading"
                                            class="form-control @error('heading') is-invalid @enderror"
                                            value="{{ old('heading', $careerHeading->heading ?? '') }}" required>
                                        @error('heading')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Heading Description</label>
                                        <textarea class="summernote @error('heading_description') is-invalid @enderror"
                                            name="heading_description">{{ old('heading_description', $careerHeading->heading_description ?? '') }}</textarea>
                                        @error('heading_description')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SEO Section --}}
                                <div class="form-section">
                                    <h5 class="section-title">SEO Settings</h5>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <input type="text" name="seo_title"
                                                    class="form-control @error('seo_title') is-invalid @enderror"
                                                    value="{{ old('seo_title', $careerHeading->seo_title ?? '') }}">
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
                                                       value="{{ old('seo_keywords', $careerHeading->seo_keywords ?? '') }}"
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
                                        <textarea name="seo_description"
                                            class="form-control auto-expand @error('seo_description') is-invalid @enderror">{{ old('seo_description', $careerHeading->seo_description ?? '') }}</textarea>
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
                                            @if($careerHeading->seo_image ?? false)
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/' . $careerHeading->seo_image) }}" class="seo-image-preview" width="200" alt="SEO Image">
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
                                    <button class="btn btn-primary mr-1" type="submit">Update Career Information</button>
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
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

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

    // Initialize Tagify
    var tagInput = document.querySelector('#seo_keywords_input');
    var tagify = new Tagify(tagInput, {
        whitelist: [],
        dropdown: { maxItems: 20, enabled: 0, closeOnSelect: false },
        callbacks: { add: updateHeight, remove: updateHeight }
    });

    function updateHeight() {
        const scrollHeight = this.DOM.scope.scrollHeight;
        const minHeight = 42;
        const maxHeight = 200;
        this.DOM.scope.style.height = 'auto';
        this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight) + 'px';
    }

    // Auto-expand textareas
    function autoExpand(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }
    document.querySelectorAll('.auto-expand').forEach(function(textarea) {
        autoExpand(textarea);
        textarea.addEventListener('input', function() { autoExpand(this); });
        window.addEventListener('load', function() { autoExpand(textarea); });
    });

    // SEO Image preview
    $('#seo_image').change(function() {
        previewImage(this, '.seo-image-preview');
        $('#remove_seo_image').val('0');
    });

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

    window.removeImage = function(type) {
        if (type === 'seo_image') {
            $('.seo-image-preview').attr('src', '').hide();
            $('#remove_seo_image').val('1');
            $('#seo_image').val('');
        }
    }

});
</script>
@endsection
