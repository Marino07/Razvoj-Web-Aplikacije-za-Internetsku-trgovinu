<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .mybttn{
            width: 20%;
        }
        .forform {
            padding-top: 30px;
            text-align: center;
        }

        label {
            font-style: oblique;
            display: block;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 50% !important;
            margin: 0 auto;
        }

        .table-container {
            margin-top: 30px;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <div class="main-panel">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="forform">
            <form action="/add_product" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Greške za "title" polje -->
                <div class="form-group">
                    <label for="product_title">Product Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="product_title" name="title" placeholder="Write product title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "description" polje -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Write description" value="{{ old('description') }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "product_price" polje -->
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" placeholder="Write product price" value="{{ old('product_price') }}">
                    @error('product_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "discount_price" polje -->
                <div class="form-group">
                    <label for="discount_price">Discount Price</label>
                    <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price" placeholder="Write discount price" value="{{ old('discount_price') }}">
                    @error('discount_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "quantity" polje -->
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="Write quantity" value="{{ old('quantity') }}">
                    @error('quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "category_id" polje -->
                <div class="form-group">
                    <label for="category">Categories</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category" name="category_id">
                        <option value="">Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Greške za "image" polje -->
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary rounded-pill">Add Category</button>
            </form>
        </div>

        <!-- Table Section --><!-- optional -->

<!-- container-scroller -->
<!-- plugins:js -->
@include('admin.script')

<!-- End custom js for this page -->
</body>
</html>
