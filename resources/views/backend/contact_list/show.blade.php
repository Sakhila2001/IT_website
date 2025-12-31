@extends('layouts.app')

@section('title', 'Contact Submission Details')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="page-title">Contact Submission Details</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('backend.contact_list.index') }}">Submissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Submission Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">
                    <i class="fas fa-envelope-open-text mr-2"></i>
                    Submission from {{ $contact_submission->name }}
                </h4>
            </div>
            
            <div class="card-body">
                @include('_message')
                
                <div class="row">
                    <!-- Left Column - User Info -->
                    <div class="col-md-6">
                        <div class="info-box mb-4 p-3 border rounded">
                            <h5 class="info-box-title text-muted">CONTACT INFORMATION</h5>
                            
                            <div class="info-item">
                                <span class="info-label">Name:</span>
                                <span class="info-value">{{ $contact_submission->name }}</span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value">
                                    <a href="mailto:{{ $contact_submission->email }}">{{ $contact_submission->email }}</a>
                                </span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Subject:</span>
                                <span class="info-value">{{ $contact_submission->subject }}</span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Submitted:</span>
                                <span class="info-value">
                                    {{ $contact_submission->created_at->timezone('Asia/Kathmandu')->format('M d, Y h:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Message -->
                    <div class="col-md-6">
                        <div class="message-box p-3 border rounded h-100">
                            <h5 class="message-box-title text-muted">MESSAGE CONTENT</h5>
                            <div class="message-content p-3 bg-light rounded">
                                {{ $contact_submission->message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-white">
                <a href="{{ route('backend.contact_list.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Submissions
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .info-box-title {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }
    
    .info-item {
        margin-bottom: 0.8rem;
    }
    
    .info-label {
        display: block;
        font-weight: 600;
        color: #6c757d;
        font-size: 0.85rem;
    }
    
    .info-value {
        display: block;
        font-size: 1rem;
        color: #343a40;
    }
    
    .message-box-title {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }
    
    .message-content {
        white-space: pre-wrap;
        line-height: 1.6;
        min-height: 200px;
    }
    
    .card-title {
        font-weight: 600;
    }
</style>
@endsection