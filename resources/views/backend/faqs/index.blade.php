@extends('layouts.app')

@section('title', 'FAQs List')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')



                    <div class="card">

                        <div class="card-header">
                            <h4>Faqs Breadcrumb Details</h4>
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                        <th class="custom-th">Small Heading</th>
                                        <td>{{ $faqsHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $faqsHeading->heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading Description</th>
                                        <td>{{ $faqsHeading->heading_description ?? '' }}</td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="card-footer text-right">
                            <a href="{{ route('backend.faqs_heading.edit', $faqsHeading?->id) }}" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>




                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>FAQs List</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('backend.faqs.create') }}" style="padding: 5px 25px;">Add New FAQs</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th  width="400px">Description</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($faqs->count() > 0)
                                        @foreach($faqs as $key => $faq)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>{{ $faq->title }}</td>
                                                <td>{!! Str::words(strip_tags($faq->description), 20, '...') !!}</td>

                                                <td>
                                                    @if ($faq->is_publish == 'Publish')
                                                        <div class="badge badge-primary badge-shadow">Published</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">Draft</div>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <a href="{{ route('backend.faqs.edit', $faq->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit</a>

                                                    <form action="{{ route('backend.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;" class="delete-form">
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

{{ $faqs->appends([
    'faqs_page' => $faqs->currentPage(),
    'teams_page' => request('teams_page'),
    'testimonials_page' => request('testimonials_page')
])->fragment('faqs_table')->links() }}
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
