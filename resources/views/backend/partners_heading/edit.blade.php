@extends('layouts.app')
@section('title', 'Partner Heading Details')

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
                <div class="col-12 col-md-12 col-lg-12">
                @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Partner Heading Details</h4>
                            <a href="{{ route('backend.partners.index') }}" class="btn btn-primary btn-sm ml-auto">Back to the List</a>

                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('backend.partners_heading.update', $partnerHeading->id) }}">
                                        @csrf
                                        @method('PUT') <!-- This converts POST to PUT -->

                                <div class="form-group">
                                    <label>Small heading</label>
                                    <input type="text" name="small_heading" class="form-control" value="{{ old('small_heading', $partnerHeading->small_heading ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="{{ old('heading', $partnerHeading->heading ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Heading Description</label>
                                    <textarea name="heading_description" class="form-control">{{ old('heading_description', $partnerHeading->heading_description ?? '') }}</textarea>
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
