<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color: red; !important;
        }

        td {
            color: #4b5563;
        }

        .container1 {
            max-width: 100%; /* Postavi maksimalnu širinu na 100% */
            margin: 70px 70px;
            padding: 30px;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #4a5568;
        }

        table th {
            background-color: #b8daff;
            color: #333;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #b8daff;
        }

        table th:last-child, table td:last-child {
            text-align: center;
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
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    <!-- end slider section -->
    <div style="margin-top: 5px" class="container1">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table>
            <thead>
            <tr>
                <th> Your address</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th style="padding-left: 35px">Order Date</th>
                <th>Total Price</th>
                <th>Action</th>


            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td data-label="Customer Name">{{$order->user->address}}</td>
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

                    <td  data-label="Order Date">{{$order->created_at}}</td>
                    <td  data-label="Total Price"><strong>${{$order->total_amount}}</strong></td>
                    @if($order->status === 'Pending')
                        <td>
                            <form action="/cancel_order/{{$order->id}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger rounded-pill" >Cancel</button>
                            </form>
                        </td>
                    @elseif($order->status === 'Cancelled')
                        <td><strong>Cancelled</strong></td>
                    @else
                        <td><strong>Expired</strong></td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- why section -->

<!-- end why section -->


<!-- arrival section -->


<!-- end arrival section -->

<!-- product section -->


<!-- end product section -->

<!-- subscribe section -->

<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_">

</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>
