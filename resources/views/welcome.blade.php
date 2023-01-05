<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        p {
            margin-bottom: -13px
        }

        span {
            font-weight: bold;
        }
    </style>
    <style>
        .demo {
            border: 1px solid #050505;
            border-collapse: collapse;
            padding: 5px;
        }

        .demo th {
            border: 1px solid #050505;
            padding: 5px;
            background: #A39F9F;
        }

        .demo td {
            border: 1px solid #050505;
            text-align: center;
            padding: 5px;
        }
    </style>

</head>

@php
    function space($space)
    {
        return str_repeat('&nbsp; ', $space);
    }
    $total = 0;
@endphp

<body class="antialiased">
    <h2 style="margin: -2px;">{{ $invoice->worker_name }}</h2>
    <hr style="border: 1px solid">
    <p>Bill To {!! space(5) !!} : {{ $invoice->bill_to }}</p>
    <p style="margin-left: 102px">{{ $invoice->bill_address }}</p>
    <p>Invoice date : {{ \Carbon\Carbon::create($invoice->invoice_date)->format('F j\, Y') }}</p>

    <br>
    <br>

    <table class="demo">
        <thead>
            <tr>
                <th>Work Description</th>
                <th>Started Date</th>
                <th>Completion Date</th>
                <th>Days Worked&nbsp;</th>
                <th>Pay/Day</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceitem as $item)
                <tr>
                    <td>{{ $item->work_description }}</td>
                    <td>{{ \Carbon\Carbon::create($item->start_date)->format('F j\, Y') }}</td>
                    <td>{{ \Carbon\Carbon::create($item->complete_date)->format('F j\, Y') }}</td>
                    <td>{{ $item->days_worked }}</td>
                    <td>{{ $item->pay_per_day }}</td>
                    <td>${{ $item->pay_per_day * $item->days_worked }}</td>
                    @php
                        $total += $item->pay_per_day * $item->days_worked;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="5">Total</td>
                <td>${{ $total }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p>Thank you for your cooperation, I hope our cooperation can continue for the next month.</p>
    <br>
    <br>
    <h4 style="margin-bottom: -13px">Worker Info:</h4>
    <p> <span>{{ $invoice->worker_name }}</span></p>
    <p> <span>{{ $invoice->worker_email }}</span></p>
    <p> <span>+{{ $invoice->worker_phone }}</span></p>
    <br>
    <h4 style="margin-bottom: -13px">Payment:</h4>
    <p>USD <span>account details(For ACH Transfer):</span></p>
    <p>Account Holder {!! space(12) !!}: <span>Chandra Aulia Tama</span></p>
    <p>ACH and Wire routing number : <span>084009519</span></p>
    <p>Account number {!! space(11) !!}: <span>9600010078614341</span></p>
    <p>Address{!! space(18) !!}: 30 W. 26th Street, Sixth Floor, New York NY 10010, United States</p>

    <br>
    <h4 style="margin-bottom: 4px">Or, Paypal:</h4>
    <a href="{{ $invoice->payment_link }}" style="font-size: 17px">{{ $invoice->payment_link }}</a>
    <p>*the payment that I receive must be in a full amount as stated in this invoice.</p>

</body>

</html>
