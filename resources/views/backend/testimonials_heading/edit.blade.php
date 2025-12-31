@extends('layouts.app')
@section('title', 'Testimonials Heading Details')

@section('style')

  <link rel="stylesheet" href="{{ asset('assets/dashboard/bundles/summernote/summernote-bs4.css') }}">
  <style>
    ul {
    list-style-type: disc !important; /* Ensures bullets for unordered lists */
    padding-left: 20px !important;
}

ol {
    list-style-type: decimal !important; /* Ensures numbers for ordered lists */
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
                <div class="col-12 col-md-12 col-lg-12">
                @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Testimonials Heading Details</h4>
                            <a href="{{ route('backend.testimonials.index') }}" class="btn btn-primary btn-sm ml-auto">Back to the List</a>

                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('backend.testimonials_heading.update', $testimonialHeading->id) }}">
                                        @csrf
                                        @method('PUT') <!-- This converts POST to PUT -->

                                <div class="form-group">
                                    <label>Small heading</label>
                                    <input type="text" name="small_heading" class="form-control" value="{{ old('small_heading', $testimonialHeading->small_heading ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="{{ old('heading', $testimonialHeading->heading ?? '') }}" required>
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

@endsection
