<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        form{
            width: 800px;
        }
        .form-group{
        }
    </style>
    <base href="/public">

    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        @include('admin.header')
        <div style="margin-top: 100px" class="container">
            <h2>Edit Order</h2>
            <form action="/order/update/{{$order->id}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input style="background-color: #2f323a;" type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->user->name }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input style="background-color: #2f323a" type="text" class="form-control" id="total_price" name="total_price" value="{{ $order->total_amount }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <input style="background-color: #2f323a;" type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $order->payment_method }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="Unpaid" {{ $order->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="delivered">Delivered</label>
                    <select name="delivered" id="delivered" class="form-control">
                        <option value="Yes" {{ $order->delivered == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $order->delivered == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="postpended">Postpended</label>
                    <select name="postpended" id="postpended" class="form-control">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_name">Order status</label>
                    <input style="background-color: #2f323a;" type="text" class="form-control" id="order_status" name="order_status" value="{{ $order->status}}" required readonly>
                </div>
                <button type="submit" class="btn btn-primary btn-custom">Update Order</button>
                <a href="/orders" class="btn btn-danger btn-custom">Cancel</a>
            </form>
        </div>


    </div>
    <!-- partial -->
</div> <!-- optional -->

<!-- container-scroller -->
<!-- plugins:js -->
@include('admin.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- End custom js for this page -->
</body>
</html>
