@extends('layouts.app')
@section('title', 'Create Portfolio')

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
                            <h4>Create Portfolio</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                           placeholder="Title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                                        <option disabled selected>Choose Option</option>
                                        @foreach ($portfoliocategories as $portfoliocategory)
                                            <option value="{{ $portfoliocategory->id }}"
                                                {{ old('category') == $portfoliocategory->id ? 'selected' : '' }}>
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
                                    <small class="form-text text-muted">Recommended size: 373×267 px. Supported formats: jpeg, png, jpg, gif, svg.</small>
                                    <div class="mt-3">
                                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow-sm" style="max-width: 200px; display: none;">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="is_publish" class="form-control @error('is_publish') is-invalid @enderror" required>
                                        <option disabled selected>Choose Option</option>
                                        <option value="Publish" {{ old('is_publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="Draft" {{ old('is_publish') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('is_publish')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <button type="reset" class="btn btn-secondary" onclick="resetImagePreview()">Reset</button>
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

    function resetImagePreview() {
        document.getElementById("imagePreview").style.display = "none";
        document.getElementById("imagePreview").src = "#";
    }
</script>
@endsection
