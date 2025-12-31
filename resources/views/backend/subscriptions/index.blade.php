@extends('layouts.app')
@section('title', 'Subscription Details')
@section('style')
<style>
    /* Delete button styling */
    .btn-danger:hover {
        color: white !important;
    }
    .btn-danger {
        color: white !important;
    }
    
    /* SweetAlert styling */
    .swal2-actions {
        display: flex;
        gap: 15px !important;
        justify-content: center;
    }
    .swal-button {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        cursor: pointer;
    }
    .swal-button--confirm {
        background-color: #F08080 !important;
        color: white !important;
    }
    .swal-button--confirm:hover {
        background-color: #a00 !important;
    }
    .swal-button--cancel {
        background-color: #DCDCDC !important;
        color: white !important;
    }
    .swal-button--cancel:hover {
        background-color: #495057 !important;
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Email Subscriptions</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Subscribed On</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($subscriptions->count() > 0)
                                        @foreach($subscriptions as $key => $subscription)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $subscription->email }}</td>
                                                <td>{{ $subscription->created_at->format('d M, Y') }}</td>
                                                <td align="center">
                                                    <form action="{{ route('backend.subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-record">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" align="center">No subscriptions found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end">
                                    @if ($subscriptions->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $subscriptions->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $subscriptions->lastPage()) as $page)
                                        <li class="page-item {{ $page == $subscriptions->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $subscriptions->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($subscriptions->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $subscriptions->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-record').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "This will permanently delete the subscription!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'swal-button swal-button--confirm swal-button--danger',
                        cancelButton: 'swal-button swal-button--cancel',
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection