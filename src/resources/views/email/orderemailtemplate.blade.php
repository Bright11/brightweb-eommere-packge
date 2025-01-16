<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaseo->site_title }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }

        .header {
            background-color: #20232a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }

        .content {
            padding: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .product-table th,
        .product-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        .product-table th {
            background-color: #f2f2f2;
        }

        .footer {
            background-color: #20232a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }

        @media only screen and (max-width: 600px) {
            .product-table {
                font-size: 12px;
            }

            .product-table th,
            .product-table td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <table class="email-container" role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr>
            <td>
                <!-- Header Section -->
                <table class="header" role="presentation" width="100%">
                    <tr>
                        <td>
                            @if ( $metaseo->site_title )
                            {{ $metaseo->site_title }}
                            @else
                            <h1>Your online order</h1>
                            @endif
                          
                           
                        </td>
                    </tr>
                </table>

                <!-- Content Section -->
                <table class="content" role="presentation" width="100%">
                    <tr>
                        <td>
                            <h2>Hello, {{ Auth::user()->name }}!</h2>
                            <p>Thank you for your order. Below are the details:</p>
                            <p style="text-align: center">Products</p>
                            <!-- Product Details Table -->
                            <table class="product-table" role="presentation">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orderdata as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>${{ $item->total_price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No products found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Payment Summary Section -->
                            <p style="text-align: center">Payment Information</p>
                            <table class="product-table" role="presentation">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>Amount Paid</th>
                                        <th>Discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>${{ $payment->original_price }}</td>
                                        <td>${{ $payment->paid_amount }}</td>
                                        <td>{{ $payment->discount_percentage }}%</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Order Details Section -->
                            <table class="product-table" role="presentation">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $payment->payment_id }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ $payment->payment_status }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Payment Method Section -->
                            <table class="product-table" role="presentation">
                                <thead>
                                    <tr>
                                        <th>Payment Type</th>
                                        <th>Mode</th>
                                        <th>Currency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $payment->payment_type }}</td>
                                        <td>{{ $payment->bank }} {{ $payment->payment_channel }}</td>
                                        <td>{{ $payment->currency }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Footer Section -->
                <table class="footer" role="presentation" width="100%">
                    <tr>
                        <td>
                            @php
                            $year=date('Y');
                        @endphp
                        @if ( $metaseo->site_title)
                        <p>&copy; {{ $year }}  {{ $metaseo->site_title }}. All rights reserved.</p>
                        @else
                       
                        @endif
                          
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
