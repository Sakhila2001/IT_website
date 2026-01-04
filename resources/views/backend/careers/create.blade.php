@extends('layouts.app')
@section('title', 'Create Career')

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
                            <h4>Create Career</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.careers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Title" value="{{ old('title') }}">
                                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                               
                                <div class="form-group">
                                    <label>Starting Date</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Job Descripion</label>
                                    <textarea class="ckeditor @error('job_descriptions') is-invalid @enderror" name="job_descriptions">{{ old('job_descriptions') }}</textarea>
                                    @error('job_descriptions')<small class="text-danger">{{ $message }}</small>@enderror
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.ckeditor').forEach(function (textarea) {
            ClassicEditor
                .create(textarea, {
                    height: 120
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>
@endsection
