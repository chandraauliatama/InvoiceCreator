<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $fileName }}</title>

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

<body class="antialiased">
    <h2 style="margin: -2px;">{{ $invoice->worker_name }}</h2>
    <hr style="border: 1px solid">
    <table width="100%" border="0" style="margin:20px 0">
        <tr style="vertical-align: top;">
            <td width="70">Bill To</td>
            <td width="1">:</td>
            <td>{{ $invoice->bill_to }} <br> {{ $invoice->bill_address }}</td>
        </tr>
        <tr>
            <td>Invoice Date</td=>
            <td>:</td>
            <td>{{ $invoice->invoice_date->format('F j\, Y') }}</td>
        </tr>
    </table>

    <table class="demo">
        <thead>
            <tr>
                <th>Work Description</th>
                <th>Started Date</th>
                <th>Completion Date</th>
                <th>Days Worked</th>
                <th>Pay/Day</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceitem->sortBy('start_date') as $item)
                <tr>
                    <td>{{ $item->work_description }}</td>
                    <td>{{ $item->start_date->format('F j\, Y') }}</td>
                    <td>{{ $item->complete_date->format('F j\, Y') }}</td>
                    <td>{{ $item->days_worked }}</td>
                    <td>{{ $item->pay_per_day }}</td>
                    <td>${{ $item->pay_per_day * $item->days_worked }}</td>
                    @php $total += $item->pay_per_day * $item->days_worked; @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="5">Total</td>
                <td>${{ $total }}</td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;Thank you for your cooperation, I hope our cooperation can continue for the next month.</p>
    <table width="100%" border="0" style="margin:5px 0">
        <tr>
            <td>
                <h4 style="margin-bottom: 0">Worker Info:</h4>
            </td>
        </tr>
        <tr>
            <td>{{ $invoice->worker_name }}</td>
        </tr>
        <tr>
            <td>{{ $invoice->worker_email }}</td>
        </tr>
        <tr>
            <td>+{{ $invoice->worker_phone }}</td>
        </tr>
    </table>
    <table width="100%" border="0" style="margin:5px 0">
        <tr>
            <td colspan="3">
                <h4 style="margin-bottom:-3px">Payment:</h4>
            </td>
            @if ($invoice->ach_transfer == true)
        </tr>
        <tr>
            <td colspan="3">USD account details<span>(for ACH transfer):</span></td>
        </tr>
        <tr>
            <td width="165">Account Holder</td>
            <td width="1"> : </td>
            <td><span>{{ $invoice->worker_name }}</span></td>
        </tr>
        <tr>
            <td>ACH and Wire routing number</td>
            <td> : </td>
            <td><span>{{ $invoice->ach_routing_number }}</span></td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td> : </td>
            <td><span>{{ $invoice->ach_account_number }}</span></td>
        </tr>
        <tr style="vertical-align:top">
            <td>Address</td>
            <td> : </td>
            <td><span>{{ $invoice->ach_account_address }}</span></td>
        </tr>
        <tr>
            <td colspan="3">
                <h4 style="margin-bottom:-1px">Or, Paypal:</h4>
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="3">
                <a href="{{ $invoice->payment_link }}" style="font-size: 17px">{{ $invoice->payment_link }}</a>
            </td>
        </tr>
        <tr>
            <td colspan="3">*the payment that I receive must be in a full amount as stated in this invoice.</td>
        </tr>
    </table>
</body>

</html>
