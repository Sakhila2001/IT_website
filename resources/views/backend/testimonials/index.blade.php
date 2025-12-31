@extends('layouts.app')

@section('title', 'Testimonial List')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')
                    <div class="card">

                        <div class="card-header">
                            <h4>Teastimonial Breadcrumb Details</h4>
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                        <th class="custom-th">Small Heading</th>
                                        <td>{{ $testimonialHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $testimonialHeading->heading ?? '' }}</td>
                                    </tr>


                                </tbody>
                            </table>

                            <div class="card-footer text-right">
                            <a href="{{ route('backend.testimonials_heading.edit', $testimonialHeading?->id) }}" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Testimonial List</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('backend.testimonials.create') }}" style="padding: 5px 25px;">Add New Testimonial</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($testimonials->count() > 0)
                                        @foreach($testimonials as $key => $testimonial)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                     @if($testimonial->image)
                                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image" width="50">
                                                     @else
                                                        No Image
                                                     @endif
                                                </td>
                                                <td>{{ $testimonial->name }}</td>
                                                <td>{!!  $testimonial->designation  !!}</td>
                                                <td>{{ $testimonial->rating }} / 5</td>
                                                <td>
                                                    @if ($testimonial->is_publish == 'Publish')
                                                        <div class="badge badge-primary badge-shadow">Published</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">Draft</div>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <a href="{{ route('backend.testimonials.edit', $testimonial->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit</a>

                                                    <form action="{{ route('backend.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                                            <td colspan="7" align="center">No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <nav aria-label="Testimonial pagination">
                                <ul class="pagination justify-content-end">
                                    @if ($testimonials->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $testimonials->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $testimonials->lastPage()) as $page)
                                        <li class="page-item {{ $page == $testimonials->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $testimonials->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($testimonials->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $testimonials->nextPageUrl() }}">Next</a>
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
    .btn-danger:hover {
        color: white !important;
    }

    .btn-danger {
        color: white !important;
    }

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
                        // If confirmed, submit the form to delete the testimonial
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
