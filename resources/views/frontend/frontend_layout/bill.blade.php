<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot tr:first-child td {
            border-top: 2px solid #ddd;
            font-weight: bold;
        }

        tfoot tr:last-child td {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Bill</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ DB::table('products')->where('id', $order->product_id)->value('product_name') }}</td>
                    <td>{{ $order->price }} DZD</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price * $order->quantity }} DZD</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
                <td style="font-weight: bold;">{{ $orders->sum('price') }} DZD</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
