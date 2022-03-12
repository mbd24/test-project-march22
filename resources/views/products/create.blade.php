@extends('layouts.master')

@section('title', 'Add New Product | Test Project March 2022')

@section('content')

<div class="card mt-3 w-100 w-lg-75">

    <div class="card-header"><h3>Add New Product</h3></div>

        <div class="card-body">

            @if ($errors->any())
                <div id="successMessage" class="alert alert-danger p-1 m-0">
                    <ul class="g-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

                <div class="col-md-12 mb-2">
                    <img id="preview-image-before-upload" src="{{ asset('assets/images/image-not-available.jpg') }}"
                    alt="preview image" style="max-height: 95px; max-width:100px">
                </div>

                <div class="mb-3 form-check w-50">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked"> Is Active </label>
                </div>

                <label for="category_id" class="form-label">Product Category</label>
                <select class="form-select mb-3 w-50" name="category_id" id="category_id">
                    <option value="" selected>Please Select Product Category</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>
                <div class="row">
                    <div class="col-md-4 col-12">
                        <label for="price_type_id" class="form-label">Product Price Type</label>
                        <select class="form-select" name="price_type_id[]" id="price_type_id">
                            <option value="" selected>Please Select Product Price Type</option>
                            @foreach ($price_types as $ptype)
                            <option value="{{ $ptype->id }}">{{ $ptype->price_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" min="0" class="form-control" name="price[]" id="price" placeholder="Price"
                                value="{{ old('price[]') }}">
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="active_date" class="form-label">Price Active From</label>
                        <input type="date" class="form-control" name="active_date[]" value="{{ date('Y-m-d') }}"
                            id="active_date">
                    </div>
                </div>

                <div class="col-12 mb-2 mt-3">
                    <button type="submit" class="btn btn-primary">Add New Product</button>
                </div>

            </form>

        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('#image').change(function(){
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#preview-image-before-upload').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });

            $(document).ready(function(){
            $("#successMessage").delay(5000).slideUp(300);
            });
        </script>
    @endpush

</div>

@endsection
