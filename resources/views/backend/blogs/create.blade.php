@extends('layouts.app')
@section('title', 'Create Blog')
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

    .form-control:not(.form-control-sm):not(.form-control-lg) {
      font-size: 14px;
      padding: 3px 15px;
      height: 42px;
    }

    .image-preview {
      max-width: 100%;
      height: auto;
      margin-top: 10px;
      border: 1px solid #ddd;
      padding: 5px;
      display: none; /* Initially hidden */
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
    .preview-wrapper {
      margin-top: 10px;
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
                <div class="col-12">
                    @include('_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Blog</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.blogs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <h5 class="section-title">Basic Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                                                @error('title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug will be auto-generated" value="{{ old('slug') }}">
                                                @error('slug')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <small class="text-muted">The slug is used in the URL. It should be unique and URL-friendly.</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category" class="form-control">
                                                    <option disabled selected>Choose Option</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Written By</label>
                                                <input type="text" name="written_by" class="form-control" placeholder="Written By">
                                                @error('written_by')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Images Section -->
                                <div class="form-section">
                                    <h5 class="section-title">Images</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Banner Image</label>
                                                <input type="file" class="form-control" name="banner_image" id="banner_image">
                                                @error('banner_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="preview-wrapper">
                                                    <img id="banner_image_preview" class="image-preview">
                                                    <span class="remove-image" onclick="clearImage('banner_image')">×</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Writer Image</label>
                                                <input type="file" class="form-control" name="writer_image" id="writer_image">
                                                @error('writer_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="preview-wrapper">
                                                    <img id="writer_image_preview" class="image-preview">
                                                    <span class="remove-image" onclick="clearImage('writer_image')">×</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Blog Image</label>
                                                <input type="file" name="file" class="form-control" id="blog_image">
                                                @error('file')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="preview-wrapper">
                                                    <img id="blog_image_preview" class="image-preview">
                                                    <span class="remove-image" onclick="clearImage('blog_image')">×</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="form-section">
                                    <h5 class="section-title">Content</h5>
                                    
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_description">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea class="ckeditor @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Top Tips for it/ Short Note for the blog</label>
                                        <textarea class="ckeditor @error('top_tips') is-invalid @enderror" name="top_tips">{{ old('top_tips') }}</textarea>
                                        @error('top_tips')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- SEO Section -->
                                <div class="form-section">
                                    <h5 class="section-title">SEO Settings</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <input type="text" name="seo_title" class="form-control" placeholder="SEO Title" value="{{ old('seo_title') }}">
                                                @error('seo_title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SEO Keywords</label>
                                                <input name="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror tall-input" id="seo_keywords_input" value="{{ old('seo_keywords') }}" placeholder="Type keywords and press enter">
                                                @error('seo_keywords')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Press Enter or comma to add keywords</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>SEO Description</label>
                                        <textarea name="seo_description" class="form-control" placeholder="SEO Description">{{ old('seo_description') }}</textarea>
                                        @error('seo_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>SEO Image (1200×630 px)</label>
                                            <input type="file" name="seo_image" class="form-control" id="seo_image">
                                            @error('seo_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="preview-wrapper">
                                                <img id="seo_image_preview" class="image-preview">
                                                <span class="remove-image" onclick="clearImage('seo_image')">×</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Publish Status</label>
                                                <select name="is_publish" class="form-control">
                                                    <option disabled selected>Choose Option</option>
                                                    <option value="Publish">Publish</option>
                                                    <option value="Draft">Draft</option>
                                                </select>
                                                @error('is_publish')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize CKEditor
        document.querySelectorAll('.ckeditor').forEach(function (textarea) {
            ClassicEditor
                .create(textarea, {
                    height: 120
                })
                .catch(error => {
                    console.error(error);
                });
        });

        // Initialize Tagify with dynamic height adjustment
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

        // Set up image preview for all image inputs
        setupImagePreview('blog_image');
        setupImagePreview('writer_image');
        setupImagePreview('seo_image');
        setupImagePreview('banner_image');

        // Slug auto-generation from title
        document.getElementById('title')?.addEventListener('input', function() {
            const slugInput = document.getElementById('slug');
            if (slugInput && !slugInput.dataset.manuallyEdited) {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });

        // Prevent auto-update if slug edited manually
        document.getElementById('slug')?.addEventListener('input', function() {
            this.dataset.manuallyEdited = 'true';
        });
    });

    // Generic function to set up image preview
    function setupImagePreview(inputId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(`${inputId}_preview`);
        const removeBtn = preview?.nextElementSibling;
        
        if (input && preview) {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    }

    // Function to clear image selection
    function clearImage(inputId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(`${inputId}_preview`);
        
        input.value = '';
        preview.src = '';
        preview.style.display = 'none';
    }
</script>
@endsection