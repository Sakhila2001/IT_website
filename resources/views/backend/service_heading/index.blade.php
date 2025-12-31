@extends('layouts.app')
@section('title', 'Service Heading Details')
@section('style')
<style>
   .custom-th {
    width: 250px; /* Set your desired width */
}
.image-preview {
    max-width: 200px;
    margin-top: 10px;
}
</style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                    @include('_message')

                        <div class="card-header">
                            <h4>Service Heading Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>

                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $serviceHeading->heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading Description</th>
                                        <td>{!! $serviceHeading->heading_description ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Small heading</th>
                                        <td>{{ $serviceHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th class="custom-th">SEO Title</th>
                                        <td>{{ $serviceHeading->seo_title ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">SEO Description</th>
                                        <td>{{ $serviceHeading->seo_description ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">SEO Keywords</th>
                                        <td>{{ $serviceHeading->seo_keywords ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">SEO Image</th>
                                        <td>
                                            @if($serviceHeading->seo_image)
                                            <img src="{{ asset('storage/' . $serviceHeading->seo_image) }}" alt="SEO Image" width="300">
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="card-footer text-right">
                                <a href="{{ route('backend.service_heading.edit') }}" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Image preview functionality can be added here if needed
</script>
@endsection
