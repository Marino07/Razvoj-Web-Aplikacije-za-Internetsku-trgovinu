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
            border: 2px solid #002b45;

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
            <form action="/resolve_category" method="post">
                @csrf
                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Write category name">
                </div>
                <button type="submit" class="btn btn-facebook rounded-pill">Add Category</button>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows; replace with dynamic data -->
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want delete this')" type="submit"
                                        class="btn btn-danger btn-sm">Delete</button>
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
