@extends('layouts.app')

@section('title', 'Service List')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')

                    <!-- Service Heading Details -->
                    <div class="card">

                        <div class="card-header">
                            <h4>Service Heading Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                        <th class="custom-th">Small heading</th>
                                        <td>{{ $serviceHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $serviceHeading->heading ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th class="custom-th">Heading Description</th>
                                        <td>{!! $serviceHeading->heading_description ?? '' !!}</td>
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
                                    <td>
                                        @php
                                            $decodedKeywords = json_decode($serviceHeading->seo_keywords, true);
                                        @endphp

                                        @if(is_array($decodedKeywords))
                                            @foreach($decodedKeywords as $keyword)
                                                <span style="
                                                    display: inline-block;
                                                    background-color: #6366f1;
                                                    color: white;
                                                    padding: 4px 10px;
                                                    border-radius: 4px;
                                                    margin: 2px;
                                                    font-size: 0.875rem;
                                                ">
                                                    {{ $keyword['value'] ?? '' }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span>No keywords</span>
                                        @endif
                                    </td>
                                </tr>
                                            <tr>
                                                <th class="custom-th">SEO Image</th>
                                                <td>
                                                    @if(!empty($serviceHeading?->seo_image))
                                                        <img src="{{ asset('storage/' . $serviceHeading->seo_image) }}" alt="SEO Image" width="300">
                                                    @else
                                                        No image added yet
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


                    <!-- Service List -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Service List</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('backend.services.create') }}" style="padding: 5px 25px;">Add New Services</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($services->count() > 0)
                                        @foreach($services as $key => $service)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @if($service->image)
                                                        <img src="{{ asset('storage/' . $service->image) }}" alt="Service Icon" width="50">
                                                    @else
                                                        No Icon
                                                    @endif
                                                </td>

                                                <td>{{ $service->title }}</td>
                                                <td>
                                                    @if ($service->is_publish == 'Publish')
                                                        <div class="badge badge-primary badge-shadow">Published</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">Draft</div>
                                                    @endif
                                                </td>
                                                <td>{{ $service->created_at->format('d M, Y') }}</td>
                                                <td align="center">
                                                    <a href="{{ route('backend.services.edit', $service->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit</a>

                                                    <form action="{{ route('backend.services.destroy', $service->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                                            <td colspan="5" align="center">No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav aria-label="User pagination">
                                <ul class="pagination justify-content-end">
                                    @if ($services->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $services->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $services->lastPage()) as $page)
                                        <li class="page-item {{ $page == $services->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $services->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($services->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $services->nextPageUrl() }}">Next</a>
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

<style>
    /* Styling for delete button */
    .btn-danger:hover {
        color: white !important; /* Ensures the font color stays white */
    }

    .btn-danger {
        color: white !important;
    }
</style>

<style>
    .swal2-actions {
        display: flex;
        gap: 15px !important; /* Adds space between buttons */
        justify-content: center;
    }
    /* Custom Swal button styles */
    .swal-button {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        border: none !important; /* Ensures border is removed */
        outline: none !important; /* Removes focus outline */
        box-shadow: none !important; /* Removes any box shadow */
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-record').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default behavior of the button

                const form = this.closest('form'); // Get the form containing the delete button

                // Show SweetAlert confirmation dialog with custom buttons
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: '<div class="swal-button__confirm">Yes, Delete it.</div>',
                    cancelButtonText: '<div class="swal-button__cancel">Cancel</div>',
                    customClass: {
                        confirmButton: 'swal-button swal-button--confirm swal-button--danger',
                        cancelButton: 'swal-button swal-button--cancel',
                    },
                    buttonsStyling: false, // Disable default SweetAlert2 button styling
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form to delete the category
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
