@extends('layouts.app')

@section('title', 'Edit Portfolio')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Portfolio</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.portfolios.update', $portfolios->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                           placeholder="Title" value="{{ old('title', $portfolios->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                                        <option disabled>Select Option</option>
                                        @foreach ($portfoliocategories as $portfoliocategory)
                                            <option value="{{ $portfoliocategory->id }}"
                                                {{ old('category', $portfolios->portfolio_category_id) == $portfoliocategory->id ? 'selected' : '' }}>
                                                {{ $portfoliocategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label>Image Upload</label>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" onchange="previewImage(event)">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <div class="mt-2">
                                        @if ($portfolios->image)
                                            <img id="imagePreview" src="{{ asset('storage/' . $portfolios->image) }}" alt="Current Image" class="img-fluid rounded shadow-sm" style="max-width: 200px;">
                                        @else
                                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow-sm" style="max-width: 200px; display: none;">
                                        @endif
                                    </div>
                                    <small class="form-text text-muted">
                                        Upload a new image to replace the current one. Recommended size: 373×267 px.
                                    </small>
                                </div>

                            

                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option disabled>Select Option</option>
                                        <option value="Publish" {{ old('is_publish', $portfolios->is_publish) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish', $portfolios->is_publish) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update Portfolio</button>
                                    <a href="{{ route('backend.portfolios.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("imagePreview");

        reader.onload = function(){
            imageField.src = reader.result;
            imageField.style.display = "block";
        };

        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
