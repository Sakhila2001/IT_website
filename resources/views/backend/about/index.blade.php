@extends('layouts.app')

@section('title', 'About Details')
@section('style')
<style>
    .custom-th {
        width: 250px;
    }
    .section-card {
        margin-bottom: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .section-header {
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
    }
    .keyword-badge {
        display: inline-block;
        background-color: #6366f1;
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        margin: 2px;
        font-size: 0.875rem;
    }
    .table-responsive {
        overflow-x: auto;
    }
    .image-preview {
        max-height: 100px;
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @include('_message')

                    <!-- Outer Card wrapping all sections -->
                    <div class="card section-card">
                        <div class="card-body">

                            <!-- Page Header Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Page Header Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Page Heading</th>
                                                    <td>{{ $about->heading ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Small Heading</th>
                                                    <td>{!! $about->small_heading ?? 'N/A' !!}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Content Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Main Content</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Description</th>
                                                    <td>{!! $about->description ?? 'N/A' !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Mission, Vision & Values Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Mission, Vision & Values</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Our Core Values</th>
                                                    <td>{!! $about->core_description ?? 'N/A' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Our Mission</th>
                                                    <td>{!! $about->mission_description ?? 'N/A' !!}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Our Vision</th>
                                                    <td>{!! $about->vision_description ?? 'N/A' !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Statistics Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Company Statistics</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Years of Experience</th>
                                                    <td>{{ $about->years_of_experience ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Number of Employees</th>
                                                    <td>{{ $about->no_of_employees ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Number of Products</th>
                                                    <td>{{ $about->no_of_users ?? 'N/A' }}</td>
                                                </tr>

                                                <tr>
                                                    <th class="custom-th">Number of Satisfied Clients</th>
                                                    <td>{{ $about->no_of_satisfied_clients ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Information Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>SEO Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">SEO Image</th>
                                                    <td>
                                                        @if(!empty($about->seo_image))
                                                            <img src="{{ asset('storage/' . $about->seo_image) }}" class="image-preview">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">SEO Title</th>
                                                    <td>{{ $about->seo_title ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">SEO Description</th>
                                                    <td>{{ $about->seo_description ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
    <th class="custom-th">SEO Keywords</th>
    <td>
        @php
            $decodedKeywords = !empty($about?->seo_keywords) ? json_decode($about->seo_keywords, true) : [];
        @endphp

        @if(is_array($decodedKeywords) && count($decodedKeywords) > 0)
            @foreach($decodedKeywords as $keyword)
                <span class="keyword-badge">
                    {{ $keyword['value'] ?? $keyword ?? '' }}
                </span>
            @endforeach
        @else
            <span>No keywords</span>
        @endif
    </td>
</tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Update Button -->
                            <div class="card-body text-right">
                                <a href="{{ route('backend.about.edit') }}" class="btn btn-primary">Update About Information</a>
                            </div>

                        </div>
                    </div> <!-- end of outer card -->

                </div>
            </div>
        </div>
    </section>
</div>

@endsection
