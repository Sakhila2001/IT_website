@extends('layouts.app')

@section('title', 'Edit Service')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
<style>
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
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
.tall-input {
    min-height: 42px;
    padding: 12px;
    line-height: 1.5;
}
.scrollable-tagify {
    min-height: 80px;
    max-height: 200px;
    overflow-y: auto;
    padding: 10px;
}
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
<div class="card-header"><h4>Edit Service</h4></div>
<div class="card-body">

<form action="{{ route('backend.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<!-- Service Title -->
<div class="form-group">
<label>Service Title</label>
<input type="text" name="title"
       value="{{ old('title', $service->title) }}"
       class="form-control @error('title') is-invalid @enderror"
       required>
@error('title')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<!-- Description -->
<div class="form-group">
<label>Description</label>
<textarea name="description"
          class="form-control ckeditor @error('description') is-invalid @enderror" required>{{ old('description', $service->description) }}</textarea>
@error('description')
<div class="error-message">{{ $message }}</div>
@enderror
</div>

<!-- Image -->
<div class="form-group">
<label>Image</label>
<input type="file" name="image"
       class="form-control-file @error('image') is-invalid @enderror"
       onchange="previewImage(event)" required>
@error('image')
<div class="text-danger">{{ $message }}</div>
@enderror

<div class="mt-2">
@if($service->image)
<img src="{{ asset('storage/'.$service->image) }}" style="max-height:150px;">
@endif
<img id="image-preview" style="display:none;max-height:150px;">
</div>
</div>

<hr>
<h6 class="mt-3">SEO Details</h6>

<!-- SEO Title -->
<div class="form-group">
<label>SEO Title</label>
<input type="text" name="seo_title"
       value="{{ old('seo_title', $service->seo_title) }}"
       class="form-control @error('seo_title') is-invalid @enderror" required>
@error('seo_title')
<div class="error-message">{{ $message }}</div>
@enderror
</div>

<!-- SEO Keywords -->
<div class="form-group">
<label>SEO Keywords</label>
<input name="seo_keywords"
       id="seo_keywords_input"
       class="form-control tall-input scrollable-tagify @error('seo_keywords') is-invalid @enderror"
       value="{{ old('seo_keywords', $service->seo_keywords) }}"
       placeholder="Type keywords and press enter" required>
@error('seo_keywords')
<div class="error-message">{{ $message }}</div>
@enderror
<small class="form-text text-muted">Press Enter or comma to add keywords</small>
</div>

<!-- SEO Description -->
<div class="form-group">
<label>SEO Description</label>
<textarea name="seo_description"
          class="form-control @error('seo_description') is-invalid @enderror"
          rows="3" required>{{ old('seo_description', $service->seo_description) }}</textarea>
@error('seo_description')
<div class="error-message">{{ $message }}</div>
@enderror
</div>

<!-- SEO Image -->
<div class="form-group">
<label>SEO Image (1200×630 px)</label>
<input type="file" name="seo_image" id="seo_image"
       class="form-control @error('seo_image') is-invalid @enderror">
@error('seo_image')
<div class="error-message">{{ $message }}</div>
@enderror

<div class="image-container mt-2" style="{{ $service->seo_image ? 'display:inline-block' : 'display:none' }}">
@if($service->seo_image)
<img id="seo_image_preview"
     src="{{ asset('storage/'.$service->seo_image) }}"
     class="image-preview" width="300">
@else
<img id="seo_image_preview" class="image-preview" width="300">
@endif
<span class="remove-image" onclick="removeSeoImage()">×</span>
</div>

<input type="hidden" name="remove_seo_image" id="remove_seo_image" value="0">
</div>

<!-- Publish Status -->
<div class="form-group">
<label>Publish Status</label>
<select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
<option value="Publish" {{ old('is_publish', $service->is_publish)=='Publish'?'selected':'' }}>Publish</option>
<option value="Draft" {{ old('is_publish', $service->is_publish)=='Draft'?'selected':'' }}>Draft</option>
</select>
@error('is_publish')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="card-footer text-right">
<button class="btn btn-primary" type="submit">Update</button>
</div>

</form>
</div>
</div>

@if(session('success'))
<div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

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
// Main image preview
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('image-preview');
        img.src = e.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

// SEO image preview
document.getElementById('seo_image').addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('seo_image_preview').src = e.target.result;
        document.querySelector('.image-container').style.display = 'inline-block';
    };
    reader.readAsDataURL(this.files[0]);
});

function removeSeoImage() {
    document.getElementById('seo_image_preview').src = '';
    document.getElementById('seo_image').value = '';
    document.getElementById('remove_seo_image').value = 1;
    document.querySelector('.image-container').style.display = 'none';
}

// CKEditor
document.querySelectorAll('.ckeditor').forEach(el => {
    ClassicEditor.create(el).catch(err => console.error(err));
});

// Tagify
const seoInput = document.querySelector('#seo_keywords_input');
if (seoInput) {
    const tagify = new Tagify(seoInput, {
        delimiters: ",",
        dropdown: { enabled: 0 }
    });
    tagify.on('change', e => seoInput.value = e.detail.value);
}
</script>
@endsection
