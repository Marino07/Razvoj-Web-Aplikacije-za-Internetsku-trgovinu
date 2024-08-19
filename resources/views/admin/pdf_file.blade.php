<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }
        .header p {
            font-size: 16px;
            margin: 5px 0;
        }
        .customer-details, .order-summary, .order-items {
            margin-bottom: 20px;
        }
        .customer-details p, .order-summary p, .order-items p {
            margin: 0 0 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f8f8;
            color: #555;
        }
        .table td {
            background-color: #fdfdfd;
        }
        .total-row td {
            font-weight: bold;
        }
        .total-amount {
            font-size: 18px;
            color: #007bff;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Order Details</h2>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
</div>

<div class="customer-details">
    <h3>Customer Information</h3>
    <p><strong>Name:</strong> {{ $order->user->name }}</p>
    <p><strong>Address:</strong> {{ $order->user->address }}</p>
    <p><strong>Email:</strong> {{ $order->user->email }}</p>
    <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
</div>

<div class="order-summary">
    <h3>Order Summary</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
            <th>Total Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>{{ $order->delivered }}</td>
            <td class="total-amount">${{ number_format($order->total_amount, 2) }}</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="order-items">
    <h3>Order Items</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price per Unit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="total-row">
            <td colspan="3">Grand Total</td>
            <td>${{ number_format($order->total_amount, 2) }} + PDV</td>
        </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
