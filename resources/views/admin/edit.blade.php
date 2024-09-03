<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Form</title>
    <style>
        body {
            background-color: #1b1e21; /* Svijetlo siva pozadina za tijelo */
            color: #c2c2c2; /* Tamno siva boja teksta */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1050px;
            margin: 60px auto;
            padding: 20px;
            background-color: #2d3748; /* Bijela pozadina za formu */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Blaga sjena oko forme */
        }

        h1 {
            text-align: center;
            color: #333; /* Tamno siva boja za naslov */
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 20px; /* Razmak između polja */
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #4b5563; /* Svijetlo tamno siva boja za labelu */
        }

        input[type="text"], input[type="number"], select, textarea {
            width: 500px;
            padding: 10px;
            border: 1px solid #ccc; /* Svijetlo siva boja obruba */
            border-radius: 4px;
            background-color: #2d3748; /* Svijetlo siva boja pozadine */
            color: #b8e0f8; /* Tamno siva boja teksta */
            box-sizing: border-box; /* Uključuje border i padding u širinu */
        }

        input[type="file"] {
            border: 1px solid #ccc; /* Svijetlo siva boja obruba */
            background-color: #b8e0f8; /* Svijetlo siva boja pozadine */
            color: #333; /* Tamno siva boja teksta */
            padding: 5px;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box; /* Uključuje border i padding u širinu */
        }

        input[type="file"]::-webkit-file-upload-button {
            background-color: #007bff; /* Svijetlo plava boja za dugme */
            border: none;
            color: #ffffff;
            padding: 8px 12px; /* Smanjena veličina dugmeta */
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #0056b3; /* Tamnija plava boja pri hoveru */
        }

        button[class="btn-update"] {
            background-color: #6b7280; /* Svijetlo plava boja za dugme */
            border: none;
            padding: 10px 10px;
            color: #ffffff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 10%; /* Dugme na 100% širine */
            box-sizing: border-box; /* Uključuje border i padding u širinu */
        }

        button[class="btn-update"]:hover {
            background-color: #0056b3; /* Tamnija plava boja pri hoveru */
        }

        .error {
            color: #ff6f6f;
            font-size: 14px;
        }
    </style>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <div class="main-panel">
        <div class="container">
            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}" placeholder="Enter product title">
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{ old('description', $product->description) }}" placeholder="Enter product description">
                        @error('description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Enter product price">
                        @error('price')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="text" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" placeholder="Enter discount price (optional)">
                        @error('discount_price')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Enter quantity">
                        @error('quantity')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category_id">
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
                </div>

                <div class="form-group">
                    <label for="image">Product Image</label><br>
                    <input type="file" id="image" name="image">
                    @error('image')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn-update" type="submit">Update</button>
            </form>
</div>
    </div>
</div>
</body>
@include('admin.script')

</html>
