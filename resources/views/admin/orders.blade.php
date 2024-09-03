<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        td {
            color: #4b5563;
        }

        .container {
            max-width: 100%; /* Postavi maksimalnu širinu na 100% */
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%; /* Proširi tablicu na punu širinu kontejnera */
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #4a5568;
        }

        table th {
            background-color: #9d937c;
            color: #333;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #383d41;
        }

        table th:last-child, table td:last-child {
            text-align: center;
        }



        .btn-info {
            background-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
                background-color: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                border-radius: 5px;
                padding: 10px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                padding-left: 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    <div class="container-fluid page-body-wrapper">

        @include('admin.header')

        <div style="margin-top: 75px" class="container">
            @if(session()->has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th> Address</th>
                    <th style="padding-left: 15px"> Phone</th>
                    <th style="padding-left: 25px">Payment Method</th>
                    <th>Order Status</th>
                    <th style="padding-left: 15px">Order Date</th>
                    <th style="padding-left: 30px">Total Price</th>


                    <th>Modify</th> <!-- Stupac Actions ostaje poravnat desno -->
                    <th style="padding-left: 25px">PDF</th> <!-- Stupac Actions ostaje poravnat desno -->

                    <th>Base</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td data-label="Order ID">{{$order->id}}</td>
                        <td data-label="Customer Name">{{$order->user->name}}</td>
                        <td data-label="Customer Name">{{$order->user->address}}</td>
                        <td data-label="Customer Name">{{$order->user->phone}}</td>
                        <td style="padding-left: 30px;!important; " data-label="Payment Method">{{{$order->payment_method}}}</td>

                        @if($order->status === 'Completed')
                            <td style="color: #3e8e41" data-label="Order Status">{{$order->status}}</td>
                        @elseif($order->status === 'Processing')
                            <td style="color: #aa5500" data-label="Order Status">{{ $order->status }}</td>
                        @elseif($order->status === 'Cancelled')
                            <td style="color: #ee040e" data-label="Order Status">{{$order->status}}</td>
                        @elseif($order->status === 'Pending')
                            <td style="color: #5E50F9" data-label="Order Status">{{$order->status}}</td>
                        @endif


                        <td style="" data-label="Order Date">{{$order->created_at}}</td>
                        <td data-label="Total Price"><strong>${{$order->total_amount}}</strong></td>


                        <td data-label="Actions">
                            <a href="/order/edit/{{$order->id}}" class="btn btn-warning">Edit</a>
                            <!--<a href="/admin/orders/{{$order->id}}/delete" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a> -->
                        </td>
                        <td> <a  href="/order/download/{{$order->id}}" target="_blank" class="btn btn-primary ">PDF</a>
                        </td>
                        @if($order->status === 'Pending')
                            <td><form action="/order/accept/{{$order->id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-behance">Accept</button>
                                </form></td>
                        @else
                            <td>Not available</td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End custom js for this page -->
</body>
@include('admin.script')
</html>
