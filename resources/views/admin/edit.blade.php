<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Form</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #e0e0e0;
        }

        input[type="text"], input[type="number"], input[type="file"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            background-color: #2c2c2c;
            color: #ffffff;
        }

        input[type="file"] {
            border: none;
        }

        button[type="submit"] {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #333;
            background-color: #2c2c2c;
            color: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .error {
            color: #ff6f6f;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Product Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $product->title) }}" placeholder="Enter product title">
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ old('description', $product->description) }}" placeholder="Enter product description">
            @error('description')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="Enter product price">
            @error('price')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="discount_price">Discount Price</label>
            <input type="text" id="discount_price" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}" placeholder="Enter discount price (optional)">
            @error('discount_price')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" placeholder="Enter quantity">
            @error('quantity')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="50px" height="50px">
            @endif
            @error('image')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-secondary rounded-pill">Update Product</button>
    </form>
</div>
</body>
</html>
