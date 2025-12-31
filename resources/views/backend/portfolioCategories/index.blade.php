@extends('layouts.app')
@section('title', 'Portfolio Category List')
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('_message')

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Portfolio Category List</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('backend.portfolioCategories.create') }}" style="padding: 5px 25px;">Add</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($portfoliocategories->count() > 0)
                                        @foreach($portfoliocategories as $key => $portfoliocategory)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $portfoliocategory->name }}</td>
                                                <td>
                                                    @if ($portfoliocategory->is_publish == 'Publish')
                                                        <div class="badge badge-primary badge-shadow">Published</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">Draft</div>
                                                    @endif
                                                </td>
                                                <td>{{ $portfoliocategory->created_at->format('d M, Y') }}</td>
                                            
                                    <td align="center">
                                                 
                                                    <a href="{{ route('backend.portfolioCategories.edit', $portfoliocategory->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Edit</a>
                                                  
                                                    <form action="{{ route('backend.portfolioCategories.destroy', $portfoliocategory->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                            <!-- Custom Pagination Section -->
                            <nav aria-label="User pagination">
                                <ul class="pagination justify-content-end">
                                    @if ($portfoliocategories->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $portfoliocategories->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach (range(1, $portfoliocategories->lastPage()) as $page)
                                        <li class="page-item {{ $page == $portfoliocategories->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $portfoliocategories->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($portfoliocategories->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $portfoliocategories->nextPageUrl() }}">Next</a>
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
