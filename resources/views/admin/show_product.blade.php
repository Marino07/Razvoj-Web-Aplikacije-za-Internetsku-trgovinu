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

        <!-- Table Section -->
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Category</th>
                    <th>Product Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows; replace with dynamic data -->
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td><img style="height: 50px; width: 50px;"  src="/storage/{{ $product->image }}"></td>


                       <td>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want delete this')" type="submit"
                                        class="btn btn-danger btn-sm">Delete</button>
                            </form>


                            <form action="{{ route('product.edit',$product->id) }}" method="GET" style="display: inline-block">
                                <button  type="submit"
                                         class="btn btn-secondary btn-sm">Edit</button>
                            </form>
                       </td>


                    </tr>
                @endforeach
                <!-- End of Example rows -->
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- optional -->

<!-- container-scroller -->
<!-- plugins:js -->
@include('admin.script')

<!-- End custom js for this page -->
</body>
</html>

