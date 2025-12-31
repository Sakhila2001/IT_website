@extends('layouts.app')
@section('title', 'Edit Contact Heading')

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
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
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
              <h4>Edit Contact Information</h4>
            </div>
            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <form method="POST" action="{{ route('backend.contact_details.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Header Section -->
                <div class="form-section">
                  <h5 class="section-title">Header Information</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $contact->heading ?? '') }}" required>
                        @error('heading')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Heading Description</label>
                    <textarea name="heading_description" class="form-control @error('heading_description') is-invalid @enderror">{{ old('heading_description', $contact->heading_description ?? '') }}</textarea>
                    @error('heading_description')
                      <div class="error-message">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- Contact Information Section -->
                <div class="form-section">
                  <h5 class="section-title">Contact Information</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="address_info" class="form-control @error('address_info') is-invalid @enderror" rows="3">{{ old('address_info', $contact->address_info ?? '') }}</textarea>
                        @error('address_info')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Head Office Address</label>
                        <textarea name="head_office" class="form-control @error('head_office') is-invalid @enderror" rows="3">{{ old('head_office', $contact->head_office ?? '') }}</textarea>
                        @error('head_office')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Branch Office Address</label>
                        <textarea name="branch_office" class="form-control @error('branch_office') is-invalid @enderror" rows="3">{{ old('branch_office', $contact->branch_office ?? '') }}</textarea>
                        @error('branch_office')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Map Embed Code</label>
                        <textarea name="map" class="form-control @error('map') is-invalid @enderror" rows="3">{{ old('map', $contact->map ?? '') }}</textarea>
                        <small class="form-text text-muted">Paste your Google Maps embed code here</small>
                        @error('map')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Primary Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $contact->phone ?? '') }}">
                        @error('phone')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Secondary Phone</label>
                        <input type="text" name="phone2" class="form-control @error('phone2') is-invalid @enderror" value="{{ old('phone2', $contact->phone2 ?? '') }}">
                        @error('phone2')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Primary Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $contact->email ?? '') }}">
                        @error('email')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Secondary Email</label>
                        <input type="email" name="email2" class="form-control @error('email2') is-invalid @enderror" value="{{ old('email2', $contact->email2 ?? '') }}">
                        @error('email2')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Social Media Section -->
                <div class="form-section">
                  <h5 class="section-title">Social Media Links</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" value="{{ old('facebook_link', $contact->facebook_link ?? '') }}">
                        @error('facebook_link')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>LinkedIn</label>
                        <input type="text" name="Linkedin_link" class="form-control @error('Linkedin_link') is-invalid @enderror" value="{{ old('Linkedin_link', $contact->Linkedin_link ?? '') }}">
                        @error('Linkedin_link')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" value="{{ old('instagram_link', $contact->instagram_link ?? '') }}">
                        @error('instagram_link')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" value="{{ old('twitter_link', $contact->twitter_link ?? '') }}">
                        @error('twitter_link')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp_link" class="form-control @error('whatsapp_link') is-invalid @enderror" value="{{ old('whatsapp_link', $contact->whatsapp_link ?? '') }}">
                    @error('whatsapp_link')
                      <div class="error-message">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- Company Information Section -->
                <div class="form-section">
                  <h5 class="section-title">Company Information</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $contact->company_name ?? '') }}">
                        @error('company_name')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Subscription Text</label>
                        <input type="text" name="subscription" class="form-control @error('subscription') is-invalid @enderror" value="{{ old('subscription', $contact->subscription ?? '') }}">
                        @error('subscription')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Company Description</label>
                    <textarea name="company_description" class="form-control @error('company_description') is-invalid @enderror">{{ old('company_description', $contact->company_description ?? '') }}</textarea>
                    @error('company_description')
                      <div class="error-message">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="row">
                    <!-- Company Logo -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Company Logo</label>
                        <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo">
                        @error('company_logo')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                        <div class="preview-container">
                          @if($contact->company_logo ?? false)
                            <div class="image-container">
                              <img src="{{ asset('storage/' . $contact->company_logo) }}" class="company-logo-preview" id="company_logo_preview" width="200" alt="Company Logo">
                              <span class="remove-image" onclick="removeImage('company_logo', '#company_logo_preview')">×</span>
                            </div>
                          @else
                            <div class="image-container" style="display: none;">
                              <img src="" class="company-logo-preview" id="company_logo_preview" width="200" alt="Company Logo Preview">
                              <span class="remove-image" onclick="removeImage('company_logo', '#company_logo_preview')">×</span>
                            </div>
                          @endif
                        </div>
                        <input type="hidden" name="remove_company_logo" id="remove_company_logo" value="0">
                      </div>
                    </div>
                    <!-- Favicon Icon -->
                    <div class="col-md-6">
                      <div class="form STOCKGROUP">
                        <label>Favicon Icon (Recommended size: 32×32 px)</label>
                        <input type="file" name="fav_image" class="form-control @error('fav_image') is-invalid @enderror" id="fav_image">
                        @error('fav_image')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                        <div class="preview-container">
                          @if($contact?->fav_image)
                            <div class="image-container">
                              <img src="{{ asset('storage/' . $contact->fav_image) }}" class="fav-icon-preview" id="fav_image_preview" width="32" alt="Favicon Icon">
                              <span class="remove-image" onclick="removeImage('fav_image', '#fav_image_preview')">×</span>
                            </div>
                          @else
                            <div class="image-container" style="display: none;">
                              <img src="" class="fav-icon-preview" id="fav_image_preview" width="32" alt="Favicon Icon Preview">
                              <span class="remove-image" onclick="removeImage('fav_image', '#fav_image_preview')">×</span>
                            </div>
                          @endif
                          <input type="hidden" name="remove_fav_image" id="remove_fav_image" value="0">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- SEO Section -->
                <div class="form-section">
                  <h5 class="section-title">SEO Settings</h5>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $contact->seo_title ?? '') }}">
                        @error('seo_title')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>SEO Keywords</label>
                        <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror" id="seo_keywords_input" value="{{ old('seo_keywords', $contact->seo_keywords ?? '') }}" placeholder="Type keywords and press enter">
                        @error('seo_keywords')
                          <div class="error-message">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>SEO Description</label>
                    <textarea name="seo_description" class="form-control auto-expand @error('seo_description') is-invalid @enderror">{{ old('seo_description', $contact->seo_description ?? '') }}</textarea>
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
                      @if($contact->seo_image ?? false)
                        <div class="image-container">
                          <img src="{{ asset('storage/' . $contact->seo_image) }}" class="seo-image-preview" id="seo_image_preview" width="200" alt="SEO Image">
                          <span class="remove-image" onclick="removeImage('seo_image', '#seo_image_preview')">×</span>
                        </div>
                      @else
                        <div class="image-container" style="display: none;">
                          <img src="" class="seo-image-preview" id="seo_image_preview" width="200" alt="SEO Image Preview">
                          <span class="remove-image" onclick="removeImage('seo_image', '#seo_image_preview')">×</span>
                        </div>
                      @endif
                    </div>
                    <input type="hidden" name="remove_seo_image" id="remove_seo_image" value="0">
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary mr-1" type="submit">Update Contact Information</button>
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
$(document).ready(function() {
  document.querySelectorAll('.ckeditor').forEach(function (textarea) {
    ClassicEditor
      .create(textarea, {
        height: 120
      })
      .catch(error => {
        console.error(error);
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
      callbacks: {
        add: updateHeight,
        remove: updateHeight
      }
    });

    // Initial height update
    updateHeight.call(tagify);

    function updateHeight() {
      const scrollHeight = this.DOM.scope.scrollHeight;
      const minHeight = 42;
      const maxHeight = 200;
      this.DOM.scope.style.height = 'auto';
      this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight) + 'px';
    }

    window.addEventListener('resize', function() {
      updateHeight.call(tagify);
    });
  }

  // Generic image preview
  function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = $(previewId);
        preview.attr('src', e.target.result).show();
        const container = preview.parent('.image-container');
        if (container.length === 0) {
          preview.wrap('<div class="image-container"></div>');
          preview.after(`<span class="remove-image" onclick="removeImage('${inputId}', '${previewId}')">×</span>`);
        }
        container.show();
        $(`#remove_${inputId}`).val('0');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Generic image removal
  window.removeImage = function(inputId, previewId) {
    const preview = $(previewId);
    preview.attr('src', '').hide();
    $(`#${inputId}`).val('');
    $(`#remove_${inputId}`).val('1');
    preview.parent('.image-container').hide();
  };

  // Image preview event listeners
  $('#company_logo').change(function() {
    previewImage('company_logo', '#company_logo_preview');
  });
  $('#fav_image').change(function() {
    previewImage('fav_image', '#fav_image_preview');
  });
  $('#seo_image').change(function() {
    previewImage('seo_image', '#seo_image_preview');
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