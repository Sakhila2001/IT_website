@extends('layouts.app')
@section('title', 'Service Heading Details')

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
    .tagify {
      --tags-disabled-bg: #F1F1F1;
      --tags-border-color: #DDD;
      --tags-hover-border-color: #CCC;
      --tags-focus-border-color: #8f8f8f;
      width: 100%;
      min-height: 200px;
      max-height: 1200px;
      overflow-y: auto;
      padding: 5px;
      line-height: 1.5;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .auto-expand {
      min-height: 100px;
      max-height: 300px;
      overflow-y: auto;
      resize: none;
      transition: height 0.2s ease;
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
              <h4>Service Heading Details</h4>
            </div>
            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <form action="{{ route('backend.service_heading.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Small Heading</label>
                  <input type="text" name="small_heading" class="form-control @error('small_heading') is-invalid @enderror"
                         value="{{ old('small_heading', $serviceHeading?->small_heading ?? '') }}" required>
                  @error('small_heading')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  <input type="text" id="heading" name="heading" class="form-control @error('heading') is-invalid @enderror"
                         value="{{ old('heading', $serviceHeading?->heading ?? '') }}" required>
                  @error('heading')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Heading Description</label>
                  <textarea class="form-control auto-expand @error('heading_description') is-invalid @enderror"
                            name="heading_description" required>{{ old('heading_description', $serviceHeading?->heading_description ?? '') }}</textarea>
                  @error('heading_description')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label>SEO Title</label>
                  <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror"
                         value="{{ old('seo_title', $serviceHeading?->seo_title ?? '') }}" required>
                  @error('seo_title')
                    <div class="error-message">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>SEO Keywords</label>
                  <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror" id="seo_keywords_input"
                         value="{{ old('seo_keywords', $serviceHeading?->seo_keywords ?? '') }}" placeholder="Type keywords and press enter">
                  @error('seo_keywords')
                    <div class="error-message">{{ $message }}</div>
                  @enderror
                  <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                </div>
                <div class="form-group">
                  <label>SEO Description</label>
                  <textarea name="seo_description" class="form-control auto-expand @error('seo_description') is-invalid @enderror">{{ old('seo_description', $serviceHeading?->seo_description ?? '') }}</textarea>
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
                  <div class="mt-3">
                    @if($serviceHeading?->seo_image)
                      <div class="image-container">
                        <img src="{{ asset('storage/' . $serviceHeading->seo_image) }}" alt="SEO Image" width="300" class="image-preview" id="image_preview">
                        <span class="remove-image" onclick="removeImage()">×</span>
                      </div>
                    @else
                      <div class="image-container" style="display: none;">
                        <img src="" alt="SEO Image Preview" width="300" class="image-preview" id="image_preview">
                        <span class="remove-image" onclick="removeImage()">×</span>
                      </div>
                    @endif
                    <input type="hidden" name="remove_image" id="remove_image" value="0">
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
      const minHeight = 42;
      const maxHeight = 200;
      this.DOM.scope.style.height = 'auto';
      this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight) + 'px';
    }
  }

  // Image preview
  $('#seo_image').change(function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#image_preview').attr('src', e.target.result);
        $('.image-container').show();
      }
      reader.readAsDataURL(this.files[0]);
    }
  });

  // Remove image
  window.removeImage = function() {
    $('#image_preview').attr('src', '');
    $('#seo_image').val('');
    $('#remove_image').val('1');
    $('.image-container').hide();
  };

  // Auto-expand textareas
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
