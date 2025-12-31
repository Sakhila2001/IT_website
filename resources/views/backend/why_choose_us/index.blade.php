@extends('layouts.app')
@section('title', 'Wny Choose Us List')
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')
                    <div class="card">

                        <div class="card-header">
                            <h4>Wy Choose Us Breadcrumb Details</h4>
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                        <th class="custom-th">Small Heading</th>
                                        <td>{{ $chooseHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $chooseHeading->heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading Description</th>
                                        <td>{{ $chooseHeading->heading_description ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Image</th>
                                        <td>
                                            @if($chooseHeading->banner_image && Storage::disk('public')->exists($chooseHeading->banner_image))
                                                <img src="{{ asset('storage/' . $chooseHeading->banner_image) }}" alt="Why Choose Us Image" style="max-width: 200px;">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="card-footer text-right">
                            <a href="{{ route('backend.why_choose_us_heading.edit', $chooseHeading?->id) }}" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Partner List</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('backend.why_choose_us.create') }}" style="padding: 5px 25px;">Add</a>
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
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($choose->count() > 0)
                                        @foreach($choose as $key => $chose)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                     @if ($chose->icon_image)
                                        <img src="{{ asset('storage/' . $chose->icon_image) }}" class="mt-2" width="50">
                                    @endif
                                </td>

                                                <td>{{ $chose->title }}</td>
                                                <td>
                                                    @if ($chose->is_publish == 'Publish')
                                                        <div class="badge badge-primary badge-shadow">Published</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">Draft</div>
                                                    @endif
                                                </td>
                                                <td>{{ $chose->created_at->format('d M, Y') }}</td>
                                                <td align="center">
                                                <a href="{{ route('backend.why_choose_us.edit', $chose->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                    <form action="{{ route('backend.why_choose_us.destroy', $chose->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                                            <td colspan="6" align="center">No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <nav aria-label="Portfolio pagination">
                                <ul class="pagination justify-content-end">
                                    @if ($choose->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $choose->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $choose->lastPage()) as $page)
                                        <li class="page-item {{ $page == $choose->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $choose->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($choose->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $choose->nextPageUrl() }}">Next</a>
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
    /* Remove the default hover color for the delete button */
    .btn-danger:hover {
        color: white !important; /* Ensures the font color stays white */

    }

    /* Optional: For better styling of the delete button */
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
    // Attach click event listener to delete buttons
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
