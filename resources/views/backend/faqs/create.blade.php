@extends('layouts.app')
@section('title', 'Create FAQs')

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
</style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')

                    <div class="page-header">
                        <!-- <h3 class="page-title">Posts</h3> -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Create FAQs</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.faqs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Title" value="{{ old('title') }}">
                                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="summernote @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Publish</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror">
                                        <option disabled selected>Choose Option</option>
                                        <option value="Publish" {{ old('is_publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')<small class="text-danger">{{ $message }}</small>@enderror
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
<script src="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.js') }}"></script>
<script>

    $(document).ready(function () {
    $('.summernote').summernote({
        height: 120
    });
});

</script>
@endsection
