@extends('layouts.app')
@section('title', 'Profile Settings')

@section('style')
<style>
    .profile-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        border: 1px solid #eaeaea;
        border-radius: 8px;
    }
    .profile-section h2 {
        margin-bottom: 1rem;
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }
    .alert-success-custom {
        background-color: #d1fae5;
        color: #065f46;
        padding: 0.75rem 1.25rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        border-left: 4px solid #10b981;
    }
    .alert-success-custom .icon {
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }
    .text-muted {
        color: #6b7280 !important;
        margin-bottom: 1.5rem;
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

                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Settings</h4>
                        </div>
                        <div class="card-body">
                            @if (session('status') === 'profile-updated')
                                <div class="alert-success-custom">
                                    <span class="icon">✓</span>
                                    <span>Your profile information has been successfully updated.</span>
                                </div>
                            @endif

                            @if (session('status') === 'password-updated')
                                <div class="alert-success-custom">
                                    <span class="icon">✓</span>
                                    <span>Your password has been successfully updated.</span>
                                </div>
                            @endif

                            @if (session('status') === 'verification-link-sent')
                                <div class="alert-success-custom">
                                    <span class="icon">✓</span>
                                    <span>A new verification link has been sent to your email address.</span>
                                </div>
                            @endif

                            <!-- Profile Information Section -->
                            <div class="profile-section">
                                <h2>Profile Information</h2>
                                <p class="text-muted">Update your account's profile information and email address.</p>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" 
                                               value="{{ old('name', $user->name) }}" required autofocus>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" 
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                            <div class="mt-2">
                                                <div class="alert alert-warning">
                                                    {{ __('Your email address is unverified.') }}
                                                    <button form="send-verification" class="btn btn-link p-0 text-warning">
                                                        {{ __('Click here to re-send the verification email.') }}
                                                    </button>
                                                </div>

                                                @if (session('status') === 'verification-link-sent')
                                                    <div class="alert-success-custom mt-2">
                                                        <span class="icon">✓</span>
                                                        <span>A new verification link has been sent to your email address.</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Update Password Section -->
                            <div class="profile-section">
                                <h2>Update Password</h2>
                                <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>

                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" id="current_password" name="current_password" 
                                               class="form-control" autocomplete="current-password">
                                        @error('current_password', 'updatePassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" id="password" name="password" 
                                               class="form-control" autocomplete="new-password">
                                        @error('password', 'updatePassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" 
                                               class="form-control" autocomplete="new-password">
                                        @error('password_confirmation', 'updatePassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>
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
<!-- Add any additional scripts if needed -->
@endsection