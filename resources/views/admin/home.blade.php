<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

    @include('admin.header')
    </div>
        <!-- partial -->
    @include('admin.body')
</div> <!-- optional -->

<!-- container-scroller -->
<!-- plugins:js -->
    @include('admin.script')

<!-- End custom js for this page -->
</body>
</html>
