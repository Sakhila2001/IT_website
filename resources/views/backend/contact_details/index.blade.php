@extends('layouts.app')
@section('title', 'Contact Details')
@section('style')
<style>
    .custom-th {
        width: 250px;
    }
    .map-container iframe {
        width: 100% !important;
        height: 300px !important;
        border: none;
        border-radius: 8px;
    }
    .section-card {
        margin-bottom: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .section-header {
        /* background-color: #f8f9fa; */
      
        font-weight: 600;
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

                            <!-- Main Contact Information Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Main Contact Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Heading</th>
                                                    <td>{{ $contact->heading ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Heading Description</th>
                                                    <td>{{ $contact->heading_description ?? 'N/A' }}</td>
                                                </tr>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Details Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Contact Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Address</th>
                                                    <td>{{ $contact->address_info ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Primary Phone</th>
                                                    <td>{{ $contact->phone ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Secondary Phone</th>
                                                    <td>{{ $contact->phone2 ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Primary Email</th>
                                                    <td>{{ $contact->email ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Secondary Email</th>
                                                    <td>{{ $contact->email2 ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media Links Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Social Media Links</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Facebook</th>
                                                    <td>{{ $contact->facebook_link ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">LinkedIn</th>
                                                    <td>{{ $contact->Linkedin_link ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Instagram</th>
                                                    <td>{{ $contact->instagram_link ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Twitter</th>
                                                    <td>{{ $contact->twitter_link ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">WhatsApp</th>
                                                    <td>{{ $contact->whatsapp_link ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Company Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Company Logo</th>
                                                    <td>
                                                        @if($contact->company_logo)
                                                            <img src="{{ asset('storage/' . $contact->company_logo) }}" alt="Company Logo" style="max-height: 50px;">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Company Name</th>
                                                    <td>{{ $contact->company_name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Company Description</th>
                                                    <td>{{ $contact->company_description ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">Subscription</th>
                                                    <td>{{ $contact->subscription ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Map Section -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h4>Location Map</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-th">Embedded Map</th>
                                                    <td class="map-container">{!! $contact->map ?? 'N/A' !!}</td>
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
                                                        @if($contact->seo_image)
                                                            <img src="{{ asset('storage/' . $contact->seo_image) }}" alt="SEO Image" style="max-height: 100px;">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">SEO Title</th>
                                                    <td>{{ $contact->seo_title ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">SEO Description</th>
                                                    <td>{{ $contact->seo_description ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="custom-th">SEO Keywords</th>
                                                    <td>
                                                        @php
                                                            $decodedKeywords = json_decode($contact->seo_keywords, true);
                                                        @endphp
                                                        @if(is_array($decodedKeywords))
                                                            @foreach($decodedKeywords as $keyword)
                                                                <span class="keyword-badge">
                                                                    {{ $keyword['value'] ?? '' }}
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

                            <!-- Update Contact Information Button -->
                           
                                
                                <div class="card-body text-right">
                                    <a href="{{ route('backend.contact_details.edit') }}" class="btn btn-primary">Update Contact Information</a>
                                </div>
                            </div>

                       
                    </div> <!-- end of outer card -->

                </div>
            </div>
        </div>
    </section>
</div>

@endsection