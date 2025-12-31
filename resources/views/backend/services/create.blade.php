@extends('layouts.app')

@section('title', 'Create Service')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
<style>
/* General styles */
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
/* SEO Keywords Tagify styling */
.tall-input {
    min-height: 42px;
    padding: 12px;
    line-height: 1.5;
}
.scrollable-tagify {
    min-height: 80px;   /* Increased visible height */
    max-height: 200px;  /* Max height before scroll appears */
    overflow-y: auto;   /* Scrollable vertically */
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
                        <div class="card-header"><h4>Create Service</h4></div>
                        <div class="card-body">
                            <form action="{{ route('backend.services.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Service Title -->
                                <div class="form-group">
                                    <label>Service Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           class="form-control @error('title') is-invalid @enderror"
                                           placeholder="Title" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control ckeditor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>


                              <!-- Image -->
<div class="form-group">
    <label>Image</label>
    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" onchange="previewImage(event)" required>
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-height: 150px;">
    </div>
</div>


                                <hr>
                                <h6 class="mt-3">SEO Details</h6>

                                <!-- SEO Title -->
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title"
                                           value="{{ old('seo_title') }}"
                                           class="form-control @error('seo_title') is-invalid @enderror" required>
                                    @error('seo_title')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SEO Keywords (Tagify) -->
                                <div class="form-group">
                                    <label>SEO Keywords</label>
                                    <input name="seo_keywords"
                                           id="seo_keywords_input"
                                           class="form-control @error('seo_keywords') is-invalid @enderror tall-input scrollable-tagify"
                                           value="{{ old('seo_keywords') }}"
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
                                              rows="3" required>{{ old('seo_description') }}</textarea>
                                    @error('seo_description')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SEO Image -->
                                <div class="form-group">
                                    <label>SEO Image (1200×630 px)</label>
                                    <input type="file" name="seo_image" id="seo_image"
                                           class="form-control @error('seo_image') is-invalid @enderror" required>
                                    @error('seo_image')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <div class="image-container mt-2" style="display:none;">
                                        <img id="seo_image_preview" class="image-preview" width="300">
                                        <span class="remove-image" onclick="removeSeoImage()">×</span>
                                    </div>
                                    <input type="hidden" name="remove_seo_image" id="remove_seo_image" value="0">
                                </div>

                                <!-- Publish Status -->
                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option disabled selected>Choose Option</option>
                                        <option value="Publish" {{ old('is_publish')=='Publish'?'selected':'' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish')=='Draft'?'selected':'' }}>Draft</option>
                                    </select>
                                    @error('is_publish')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
// Image preview
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    if(input.files[0]) reader.readAsDataURL(input.files[0]);
}

// SEO image preview
document.getElementById('seo_image').addEventListener('change', function() {
    if(this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const container = document.querySelector('.image-container');
            document.getElementById('seo_image_preview').src = e.target.result;
            container.style.display = 'inline-block';
        }
        reader.readAsDataURL(this.files[0]);
    }
});
function removeSeoImage() {
    document.getElementById('seo_image_preview').src = '';
    document.getElementById('seo_image').value = '';
    document.getElementById('remove_seo_image').value = '1';
    document.querySelector('.image-container').style.display = 'none';
}

// Initialize CKEditor
document.querySelectorAll('.ckeditor').forEach(textarea => {
    ClassicEditor.create(textarea).catch(err => console.error(err));
});

// Initialize Tagify with auto-expand
const seoInput = document.querySelector('#seo_keywords_input');
if(seoInput){
    const tagify = new Tagify(seoInput, {
        delimiters: ",",
        dropdown: { enabled: 0 },
        callbacks: { add: adjustHeight, remove: adjustHeight }
    });
    function adjustHeight() {
        const minHeight = 42;
        const maxHeight = 300;
        const scrollHeight = this.DOM.scope.scrollHeight;
        this.DOM.scope.style.height = Math.min(Math.max(scrollHeight, minHeight), maxHeight)+'px';
    }
    tagify.on('change', e => { seoInput.value = e.detail.value });
}
</script>
@endsection
