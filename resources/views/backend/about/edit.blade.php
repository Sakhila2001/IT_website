@extends('layouts.app')
@section('title', 'About Details')

@section('style')
  <style>
    .ck-content ul {
      list-style-type: disc !important;
      padding-left: 20px !important;
    }
    .ck-content ol {
      list-style-type: decimal !important;
      padding-left: 20px !important;
    }
    .ck-content h1 { font-size: 2.5rem !important; font-weight: bold !important; }
    .ck-content h2 { font-size: 2rem !important; font-weight: bold !important; }
    .ck-content h3 { font-size: 1.75rem !important; font-weight: bold !important; }
    .ck-content h4 { font-size: 1.5rem !important; font-weight: bold !important; }
    .ck-content h5 { font-size: 1.25rem !important; font-weight: bold !important; }
    .ck-content h6 { font-size: 1rem !important; font-weight: bold !important; }
    .image-preview {
      max-height: 100px;
      margin-top: 10px;
    }
    .form-control:not(.form-control-sm):not(.form-control-lg) {
      font-size: 14px;
      padding: 3px 15px;
      height: 42px;
    }
    .custom-file-label::after {
      content: "Browse";
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
    .preview-container img {
      max-width: 200px;
      max-height: 200px;
      border: 1px solid #ddd;
      padding: 5px;
      display: block;
    }
    .image-container {
      position: relative;
      display: inline-block;
      margin-top: 10px;
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
      display: none;
    }
    .image-container img:not([src=""]) + .remove-image {
      display: block;
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
    .tagify {
      --tags-disabled-bg: #F1F1F1;
      --tags-border-color: #DDD;
      --tags-hover-border-color: #CCC;
      --tags-focus-border-color: #8f8f8f;
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
    .tall-input {
      min-height: 42px;
      padding: 12px;
      line-height: 1.5;
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
              <h4>About Details</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('backend.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Page Header Section -->
                <div class="form-section">
                  <h5 class="section-title">Page Header</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Image 1 (Recommended size: 600 × 405 px)</label>
                        <input type="file" name="image1" class="form-control" id="image1_input">
                        @error('image1')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="banner-preview-container">
                          @if($about?->image1)
                            <div class="image-container">
                              <img src="{{ asset('storage/' . $about->image1) }}" alt="Image 1" class="image-preview" id="image1_preview">
                              <span class="remove-image" onclick="removeImage('image1_input', '#image1_preview')">×</span>
                            </div>
                          @else
                            <div class="image-container" style="display: none;">
                              <img src="" alt="Image 1 Preview" class="image-preview" id="image1_preview">
                              <span class="remove-image" onclick="removeImage('image1_input', '#image1_preview')">×</span>
                            </div>
                          @endif
                          <input type="hidden" name="remove_image1" id="remove_image1" value="0">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Image 2 (Recommended size: 304 × 205 px)</label>
                        <input type="file" name="image2" class="form-control" id="image2_input">
                        @error('image2')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="banner-preview-container">
                          @if($about?->image2)
                            <div class="image-container">
                              <img src="{{ asset('storage/' . $about->image2) }}" alt="Image 2" class="image-preview" id="image2_preview">
                              <span class="remove-image" onclick="removeImage('image2_input', '#image2_preview')">×</span>
                            </div>
                          @else
                            <div class="image-container" style="display: none;">
                              <img src="" alt="Image 2 Preview" class="image-preview" id="image2_preview">
                              <span class="remove-image" onclick="removeImage('image2_input', '#image2_preview')">×</span>
                            </div>
                          @endif
                          <input type="hidden" name="remove_image2" id="remove_image2" value="0">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Page Heading</label>
                        <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $about?->heading ?? '') }}">
                        @error('heading') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Small Heading</label>
                        <input type="text" name="small_heading" class="form-control @error('small_heading') is-invalid @enderror" value="{{ old('small_heading', $about?->small_heading ?? '') }}">
                        @error('small_heading') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="ckeditor @error('description') is-invalid @enderror" name="description">{{ old('description', $about?->description ?? '') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>
                <!-- About Content Section -->
                <div class="form-section">
                  <h5 class="section-title">About Content</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Our Core Values</label>
                        <textarea class="ckeditor @error('core_description') is-invalid @enderror" name="core_description">{{ old('core_description', $about?->core_description ?? '') }}</textarea>
                        @error('core_description') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Our Mission</label>
                        <textarea class="ckeditor @error('mission_description') is-invalid @enderror" name="mission_description">{{ old('mission_description', $about?->mission_description ?? '') }}</textarea>
                        @error('mission_description') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Our Vision</label>
                    <textarea class="ckeditor @error('vision_description') is-invalid @enderror" name="vision_description">{{ old('vision_description', $about?->vision_description ?? '') }}</textarea>
                    @error('vision_description') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                </div>
                <!-- Statistics Section -->
                <div class="form-section">
                  <h5 class="section-title">Statistics</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="number" name="years_of_experience" class="form-control @error('years_of_experience') is-invalid @enderror" value="{{ old('years_of_experience', $about?->years_of_experience ?? '') }}">
                        @error('years_of_experience') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Number of Employees</label>
                        <input type="number" name="no_of_employees" class="form-control @error('no_of_employees') is-invalid @enderror" value="{{ old('no_of_employees', $about?->no_of_employees ?? '') }}">
                        @error('no_of_employees') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Number of Products</label>
                        <input type="number" name="no_of_users" class="form-control @error('no_of_users') is-invalid @enderror" value="{{ old('no_of_users', $about?->no_of_users ?? '') }}">
                        @error('no_of_users') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Number of Satisfied Clients</label>
                        <input type="number" name="no_of_satisfied_clients" class="form-control @error('no_of_satisfied_clients') is-invalid @enderror" value="{{ old('no_of_satisfied_clients', $about?->no_of_satisfied_clients ?? '') }}">
                        @error('no_of_satisfied_clients') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Counter Background Image</label>
                        <input type="file" class="form-control @error('counter_image') is-invalid @enderror" name="counter_image" id="counter_image">
                        @error('counter_image') <span class="text-danger d-block">{{ $message }}</span> @enderror
                        <div class="preview-container">
                          @if($about?->counter_image)
                            <div class="image-container">
                              <img src="{{ asset('storage/' . $about->counter_image) }}" id="counter_image_preview" alt="Counter Image">
                              <span class="remove-image" onclick="removeImage('counter_image', '#counter_image_preview')">×</span>
                            </div>
                          @else
                            <img src="" id="counter_image_preview" style="display: none;" alt="Counter Image Preview">
                          @endif
                        </div>
                        <input type="hidden" name="remove_counter_image" id="remove_counter_image" value="0">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- SEO Settings Section -->
                <div class="form-section">
                  <h5 class="section-title">SEO Settings</h5>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $about?->seo_title ?? '') }}">
                        @error('seo_title')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>SEO Keywords</label>
                        <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror tall-input" id="seo_keywords_input" value="{{ old('seo_keywords', $about?->seo_keywords ?? '') }}" placeholder="Type keywords and press enter">
                        @error('seo_keywords')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>SEO Description</label>
                    <textarea name="seo_description" class="form-control auto-expand @error('seo_description') is-invalid @enderror">{{ old('seo_description', $about?->seo_description ?? '') }}</textarea>
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
                      @if($about?->seo_image)
                        <div class="image-container">
                          <img src="{{ asset('storage/' . $about->seo_image) }}" id="seo_image_preview" width="200" alt="SEO Image">
                          <span class="remove-image" onclick="removeImage('seo_image', '#seo_image_preview')">×</span>
                        </div>
                      @else
                        <img src="" id="seo_image_preview" style="display: none;" width="200" alt="SEO Image Preview">
                      @endif
                    </div>
                    <input type="hidden" name="remove_seo_image" id="remove_seo_image" value="0">
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary" type="submit">Update</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
// Generic function to preview images
function previewImage(input, previewId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = $(previewId);
      preview.attr('src', e.target.result).show();
      const container = preview.parent('.image-container');
      if (container.length === 0) {
        preview.wrap('<div class="image-container"></div>');
        preview.after(`<span class="remove-image" onclick="removeImage('${input.id}', '${previewId}')">×</span>`);
      }
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
$(document).ready(function() {
  // Initialize CKEditor
  document.querySelectorAll('.ckeditor').forEach(function (textarea) {
    ClassicEditor
      .create(textarea, {
        height: 120,
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
          'undo', 'redo'
        ]
      })
      .then(editor => {
        editor.model.document.on('change:data', () => {
          editor.updateSourceElement();
        });
      })
      .catch(error => {
        console.error('CKEditor initialization error:', error);
      });
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
      delimiters: ",",
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
    // Ensure Tagify sends comma-separated string
    tagify.on('change', function(e) {
      input.value = e.detail.value;
    });
  }

  // Image preview event listeners
  $('#image1_input').change(function() {
    previewImage(this, '#image1_preview');
    $('#remove_image1').val('0');
  });
  $('#image2_input').change(function() {
    previewImage(this, '#image2_preview');
    $('#remove_image2').val('0');
  });
  $('#counter_image').change(function() {
    previewImage(this, '#counter_image_preview');
    $('#remove_counter_image').val('0');
  });
  $('#seo_image').change(function() {
    previewImage(this, '#seo_image_preview');
    $('#remove_seo_image').val('0');
  });

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
    window.addEventListener('load', function() {
      autoExpand(textarea);
    });
  });
});
</script>
@endsection
