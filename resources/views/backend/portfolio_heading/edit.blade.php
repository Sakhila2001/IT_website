@extends('layouts.app')
@section('title', 'Portfolio Heading Details')

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
      margin-bottom: 15px;
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
    .banner-preview-container {
      margin-top: 15px;
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
              <h4>Portfolio Heading Details</h4>
            </div>
            <div class="card-body">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <form action="{{ route('backend.portfolio_heading.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label>Small heading</label>
                  <input type="text" name="small_heading" class="form-control"
                         value="{{ old('small_heading', $portfolioHeading->small_heading ?? '') }}">
                  @error('small_heading')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  <input type="text" name="heading" class="form-control"
                         value="{{ old('heading', $portfolioHeading->heading ?? '') }}" required>
                  @error('heading')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="heading_description" class="form-control" required>{{ old('heading_description', $portfolioHeading->heading_description ?? '') }}</textarea>
                  @error('heading_description')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>SEO Title</label>
                  <input type="text" name="seo_title" class="form-control"
                         value="{{ old('seo_title', $portfolioHeading->seo_title ?? '') }}" required>
                  @error('seo_title')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>SEO Description</label>
                  <textarea name="seo_description" class="form-control" required>{{ old('seo_description', $portfolioHeading->seo_description ?? '') }}</textarea>
                  @error('seo_description')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>SEO Keywords</label>
                  <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror tall-input" id="seo_keywords_input" value="{{ old('seo_keywords', $portfolioHeading->seo_keywords ?? '') }}" placeholder="Type keywords and press enter">
                  @error('seo_keywords')
                    <div class="error-message">{{ $message }}</div>
                  @enderror
                  <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                </div>
                <div class="form-group">
                  <label>SEO Image (1200×630 px)</label>
                  <input type="file" name="seo_image" class="form-control" id="seo_image">
                  @error('seo_image')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                  @if($portfolioHeading->seo_image ?? false)
                    <div class="mt-3">
                      <div class="image-container">
                        <img src="{{ asset('storage/' . $portfolioHeading->seo_image) }}" alt="SEO Image" width="300" class="image-preview" id="image_preview">
                        <span class="remove-image" onclick="removeImage()">×</span>
                      </div>
                      <input type="hidden" name="remove_image" id="remove_image" value="0">
                    </div>
                  @endif
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
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>



  // Image preview for SEO image
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




  // Remove SEO image
  window.removeImage = function() {
    $('#image_preview').attr('src', '');
    $('#remove_image').val('1');
    $('.image-container').hide();
  }

  // Tagify initialization
  const input = document.querySelector('#seo_keywords_input');
  if (input) {
    new Tagify(input, {
      whitelist: [],
      dropdown: {
        maxItems: 20,
        enabled: 0,
        closeOnSelect: false
      }
    });
  }
</script>
@endsection
